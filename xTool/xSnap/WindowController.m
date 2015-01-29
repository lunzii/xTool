//
//  WindowController.m
//  xSnap
//
//  Created by olunx on 15/1/27.
//  Copyright (c) 2015年 olunx. All rights reserved.
//

#import "WindowController.h"
#import "ImageMounter.h"

#include <stdio.h>
#include <string.h>
#include <stdlib.h>
#include <errno.h>
#include <time.h>

#include <libimobiledevice/libimobiledevice.h>
#include <libimobiledevice/lockdown.h>
#include <libimobiledevice/screenshotr.h>

@interface WindowController ()

@end

@implementation WindowController

- (void)windowDidLoad {
    [super windowDidLoad];
    self.contentView = self.window.contentView;

    if(self.checkDevice){
        [self takeScreenShot];
    }else{
        [self showTextView:@"设备未连接"];
    }
}

-(void)showTextView: (NSString *)text{
    if(self.textView == nil) {
        [self removeImageView];
        self.textView = [[NSTextView alloc] init];
        self.textView.frame = CGRectZero;
        self.textView.alignment = NSCenterTextAlignment;
        self.textView.translatesAutoresizingMaskIntoConstraints = NO;
        self.textView.backgroundColor = [NSColor clearColor];
        self.textView.textColor = [NSColor blackColor];
        self.textView.font = [NSFont systemFontOfSize:14.0f];

        [self.contentView addSubview:self.textView];
        [self setCenterConstraints:self.textView toSuperView:self.contentView];
    }
    [self.textView.textStorage.mutableString setString:@""];
    [self.textView insertText:text];
}

-(void)removeTextView{
    if(self.textView){
        [self.textView removeFromSuperview];
        self.textView = nil;
    }
}

-(void)showImageView: (NSImage *)image{
    if(self.imageView == nil) {
        [self removeTextView];
        self.imageView = [[NSImageView alloc] init];
        self.imageView.frame = CGRectMake(0, 0, 320, 480);
        [self.contentView addSubview:self.imageView];
        [self setFillConstraints:self.imageView toSuperView:self.contentView];
    }
    self.imageView.image = image;
}

-(void)removeImageView{
    if(self.imageView){
        [self.imageView removeFromSuperview];
        self.imageView = nil;
    }
}

- (IBAction)clickedRefresh:(id)sender {
    NSArray *paths = NSSearchPathForDirectoriesInDomains(NSApplicationSupportDirectory, NSUserDomainMask, YES);
    NSString *path = [paths objectAtIndex:0];
    NSLog(@"path: %@", [path stringByAppendingPathComponent:@"xSnap"]);
    if(self.checkDevice){
        [self takeScreenShot];
    }else{
        [self showTextView:@"设备未连接"];
    }
}



- (BOOL) checkDevice{
    BOOL result = NO;
    idevice_t device = NULL;
    char *udid = NULL;
    if (IDEVICE_E_SUCCESS == idevice_new(&device, udid)){
        result = YES;
        idevice_free(device);
        free(udid);
    }
    return result;
}

- (void) takeScreenShot{
    idevice_t device = NULL;
    lockdownd_client_t lckd = NULL;
    lockdownd_error_t ldret = LOCKDOWN_E_UNKNOWN_ERROR;
    screenshotr_client_t shotr = NULL;
    lockdownd_service_descriptor_t service = NULL;
    char *udid = NULL;

    if (IDEVICE_E_SUCCESS != idevice_new(&device, udid)) {
        [self showTextView:@"设备未连接"];
        return;
    }
    if (LOCKDOWN_E_SUCCESS != (ldret = lockdownd_client_new_with_handshake(device, &lckd, NULL))) {
        idevice_free(device);
        free(udid);
        [self showTextView:[NSString stringWithFormat:@"设备连接失败，错误码 %d", ldret]];
        return;
    }
    lockdownd_start_service(lckd, "com.apple.mobile.screenshotr", &service);
    lockdownd_client_free(lckd);
    if (service && service->port > 0) {
        if (screenshotr_client_new(device, service, &shotr) == SCREENSHOTR_E_SUCCESS){
            char *imgdata = NULL;
            uint64_t imgsize = 0;
            if (screenshotr_take_screenshot(shotr, &imgdata, &imgsize) == SCREENSHOTR_E_SUCCESS) {
                NSData *data = [NSData dataWithBytes:imgdata length:imgsize];
                NSBitmapImageRep *imageRep = [[NSBitmapImageRep alloc] initWithData:data];
                NSImage *image = [[NSImage alloc] init];
                [image addRepresentation:imageRep];
                [self showImageView:image];
                free(imgdata);
            } else {
                [self showTextView:@"获取截图失败！"];
            }
            screenshotr_client_free(shotr);
        }else{
            [self showTextView:@"获取截图失败！"];
        }
    }else{
        [self showTextView:@"未开启开发者功能！"];
    }

    if (service)
        lockdownd_service_descriptor_free(service);

    idevice_free(device);
}

- (IBAction)clickedSnap:(id)sender {
    NSLog(@"mount");
    NSString *path = [[NSBundle mainBundle] pathForResource:@"DeveloperDiskImage" ofType:@"dmg"];
    if ([[NSFileManager defaultManager] fileExistsAtPath:path]){
        [ImageMounter mount:[path UTF8String]];
    }
}

- (IBAction)clickedRecord:(id)sender {
}

- (IBAction)clickedMore:(id)sender {
}

- (void)setFillConstraints:(NSView *)view toSuperView:(NSView *)superView {
    NSLayoutConstraint *width = [NSLayoutConstraint
            constraintWithItem:view
                     attribute:NSLayoutAttributeWidth
                     relatedBy:0
                        toItem:superView
                     attribute:NSLayoutAttributeWidth
                    multiplier:1.0
                      constant:0];
    NSLayoutConstraint *height = [NSLayoutConstraint
            constraintWithItem:view
                     attribute:NSLayoutAttributeHeight
                     relatedBy:0
                        toItem:superView
                     attribute:NSLayoutAttributeHeight
                    multiplier:1.0
                      constant:0];
    NSLayoutConstraint *top = [NSLayoutConstraint
            constraintWithItem:view
                     attribute:NSLayoutAttributeTop
                     relatedBy:NSLayoutRelationEqual
                        toItem:superView
                     attribute:NSLayoutAttributeTop
                    multiplier:1.0f
                      constant:0.f];
    NSLayoutConstraint *leading = [NSLayoutConstraint
            constraintWithItem:view
                     attribute:NSLayoutAttributeLeading
                     relatedBy:NSLayoutRelationEqual
                        toItem:superView
                     attribute:NSLayoutAttributeLeading
                    multiplier:1.0f
                      constant:0.f];
    [superView addConstraint:width];
    [superView addConstraint:height];
    [superView addConstraint:top];
    [superView addConstraint:leading];
}

- (void)setCenterConstraints:(NSView *)view toSuperView:(NSView *)superView {
    NSLayoutConstraint *width = [NSLayoutConstraint constraintWithItem:view
                                                             attribute:NSLayoutAttributeWidth
                                                             relatedBy:NSLayoutRelationEqual
                                                                toItem:nil
                                                             attribute:NSLayoutAttributeNotAnAttribute
                                                            multiplier:1
                                                              constant:200];
    NSLayoutConstraint *height = [NSLayoutConstraint constraintWithItem:view
                                                              attribute:NSLayoutAttributeHeight
                                                              relatedBy:NSLayoutRelationEqual
                                                                 toItem:nil
                                                              attribute:NSLayoutAttributeNotAnAttribute
                                                             multiplier:1
                                                               constant:30];
    NSLayoutConstraint *centerX = [NSLayoutConstraint
            constraintWithItem:view
                     attribute:NSLayoutAttributeCenterX
                     relatedBy:NSLayoutRelationEqual
                        toItem:superView
                     attribute:NSLayoutAttributeCenterX
                    multiplier:1.f
                      constant:0.f];
    NSLayoutConstraint *centerY = [NSLayoutConstraint
            constraintWithItem:view
                     attribute:NSLayoutAttributeCenterY
                     relatedBy:NSLayoutRelationEqual
                        toItem:superView
                     attribute:NSLayoutAttributeCenterY
                    multiplier:1.f
                      constant:0.f];
    [superView addConstraint:width];
    [superView addConstraint:height];
    [superView addConstraint:centerX];
    [superView addConstraint:centerY];
}

@end
