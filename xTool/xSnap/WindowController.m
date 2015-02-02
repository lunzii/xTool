//
//  WindowController.m
//  xSnap
//
//  Created by olunx on 15/1/27.
//  Copyright (c) 2015年 olunx. All rights reserved.
//

#import "WindowController.h"
#import "ImageMounter.h"

#import <MBProgressHUD.h>

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

    if (self.checkDevice) {
        [self takeScreenShot];
    } else {
        [self showTextView:NSLocalizedString(@"device_connect_false", nil)];
    }
}

- (void)showTextView:(NSString *)text {
    if (self.textView == nil) {
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

- (void)removeTextView {
    if (self.textView) {
        [self.textView removeFromSuperview];
        self.textView = nil;
    }
}

- (void)showImageView:(NSImage *)image width:(float)width height:(float)height {

    float scale = 2;
    if (height >= 1536) {
        scale = 4.0f;
    } else if (height >= 1334) {
        scale = 3.0f;
    }
    width /= scale;
    height /= scale;

    if (self.imageView == nil) {
        [self removeTextView];
        self.imageView = [[NSImageView alloc] init];
        [self.contentView addSubview:self.imageView];
        self.imageView.frame = CGRectMake(0, 0, width, height);
        [self setFillConstraints:self.imageView toSuperView:self.contentView];
    }
    self.imageView.frame = CGRectMake(0, 0, width, height);
    self.imageView.image = image;
    float x = [NSScreen mainScreen].frame.size.width / 2 - width / 2;
    float y = [NSScreen mainScreen].frame.size.height / 2 - height / 2;
    [self.window setFrame:CGRectMake(x, y, width, height + 68) display:YES animate:YES];
//    NSLog(@"image width:%f height:%f", width, height);
//    NSLog(@"window width:%f height:%f", width, height);
//    NSLog(@"window x:%f y:%f", x, y);
}

- (void)removeImageView {
    if (self.imageView) {
        [self.imageView removeFromSuperview];
        self.imageView = nil;
    }
}

- (IBAction)clickedRefresh:(id)sender {
    if (self.checkDevice) {
        [self takeScreenShot];
    } else {
        [self showTextView:NSLocalizedString(@"device_connect_false", nil)];
    }
}

- (IBAction)clickedMore:(id)sender {
    [[NSWorkspace sharedWorkspace] openURL:[NSURL URLWithString:@"http://lunzii.com"]];
}

- (BOOL)checkDevice {
    BOOL result = NO;
    idevice_t device = NULL;
    char *udid = NULL;
    if (IDEVICE_E_SUCCESS == idevice_new(&device, udid)) {
        result = YES;
        idevice_free(device);
        free(udid);
    }
    return result;
}

- (NSString *)getOSVersion {
    NSString *version = nil;

    char *udid = NULL;
    idevice_t device = NULL;
    lockdownd_client_t lckd = NULL;

    if (IDEVICE_E_SUCCESS != idevice_new(&device, udid)) {
        return nil;
    }
    free(udid);

    if (LOCKDOWN_E_SUCCESS != lockdownd_client_new_with_handshake(device, &lckd, "ideviceimagemounter")) {
        idevice_free(device);
        return nil;
    }

    plist_t pver = NULL;
    char *product_version = NULL;
    lockdownd_get_value(lckd, NULL, "ProductVersion", &pver);
    if (pver && plist_get_node_type(pver) == PLIST_STRING) {
        plist_get_string_val(pver, &product_version);
    }
    int product_version_major = 0;
    int product_version_minor = 0;
    if (product_version) {
        if (sscanf(product_version, "%d.%d.%*d", &product_version_major, &product_version_minor) == 2) {
            version = [NSString stringWithFormat:@"%d.%d", product_version_major, product_version_minor];
        }
    }

    if (lckd) {
        lockdownd_client_free(lckd);
    }
    idevice_free(device);
    if (pver) {
        free(pver);
    }
    if (product_version) {
        free(product_version);
    }
    NSLog(@"%@", version);
    return version;
}

- (void)mountImage {
    MBProgressHUD *hud = [MBProgressHUD showHUDAddedTo:self.window.contentView animated:YES];
    hud.dimBackground = YES;
    hud.labelText = NSLocalizedString(@"device_initialize", nil);
    __typeof(self) __weak weakSelf = self;
    dispatch_async(dispatch_get_global_queue(DISPATCH_QUEUE_PRIORITY_LOW, 0), ^{
        BOOL result = NO;
        NSString *version = [NSString stringWithFormat:@"%@/DeveloperDiskImage", [self getOSVersion]];
        NSString *dmgPath = [[NSBundle mainBundle] pathForResource:version ofType:@"dmg"];
//        result = [ImageMounter mount:[path UTF8String]];

        NSString *cmd = [[NSBundle mainBundle] pathForResource:@"mounter" ofType:nil];

        NSTask *task = [[NSTask alloc] init];
        task.launchPath = cmd;
        task.arguments = @[dmgPath];

        NSPipe *pipe = [NSPipe pipe];
        task.standardOutput = pipe;

        NSFileHandle *file = pipe.fileHandleForReading;
        [task launch];
        [task waitUntilExit];

        NSString *string = [[NSString alloc] initWithData:file.readDataToEndOfFile
                                                 encoding:NSUTF8StringEncoding];
        if ([string rangeOfString:@"Status: Complete"].location != NSNotFound) {
            result = YES;
        }

//        NSLog(@"dmgPath: %@", dmgPath);
//        NSLog(@"cmd: %@", cmd);
//        NSLog(@"cmd output:\n%@", string);

        dispatch_async(dispatch_get_main_queue(), ^{
            [hud hide:YES];
            if (result) {
                [weakSelf takeScreenShot];
            } else {
                [weakSelf showTextView:NSLocalizedString(@"device_initialize_fail", nil)];
            }
        });
    });
}

- (void)takeScreenShot {
    __typeof(self) __weak weakSelf = self;
    MBProgressHUD *hud = [MBProgressHUD showHUDAddedTo:self.window.contentView animated:YES];
    hud.dimBackground = YES;
    hud.labelText = @"正在截图...";
    dispatch_async(dispatch_get_global_queue(DISPATCH_QUEUE_PRIORITY_LOW, 0), ^{
        char *msg = NULL;
        boolean_t success = false;
        boolean_t init = true;

        char *imgdata = NULL;
        uint64_t imgsize = 0;

        idevice_t device = NULL;
        lockdownd_client_t lckd = NULL;
        screenshotr_client_t shotr = NULL;
        lockdownd_service_descriptor_t service = NULL;
        char *udid = NULL;

        if (IDEVICE_E_SUCCESS == idevice_new(&device, udid)) {
            if (LOCKDOWN_E_SUCCESS == lockdownd_client_new_with_handshake(device, &lckd, NULL)) {
                lockdownd_start_service(lckd, "com.apple.mobile.screenshotr", &service);
                lockdownd_client_free(lckd);
                if (service && service->port > 0) {
                    if (screenshotr_client_new(device, service, &shotr) == SCREENSHOTR_E_SUCCESS) {
                        if (screenshotr_take_screenshot(shotr, &imgdata, &imgsize) == SCREENSHOTR_E_SUCCESS) {
                            success = true;
                        } else {
                            msg = [NSLocalizedString(@"device_screenshot_fail", nil) UTF8String];
                        }
                        screenshotr_client_free(shotr);
                    } else {
                        msg = [NSLocalizedString(@"device_screenshot_fail", nil) UTF8String];
                    }
                } else {
                    init = false;
                    msg = [NSLocalizedString(@"device_initialize_false", nil) UTF8String];
                }
            } else {
                msg = [NSLocalizedString(@"device_connect_fail", nil) UTF8String];
            }
        } else {
            msg = [NSLocalizedString(@"device_connect_false", nil) UTF8String];
        }
        if (service) {
            lockdownd_service_descriptor_free(service);
        }
        if (device) {
            idevice_free(device);
        }
        if (udid) {
            free(udid);
        }
//        if(msg){
//            free(msg);
//        }
        dispatch_async(dispatch_get_main_queue(), ^{
            [hud hide:YES];
            if (init == true) {
                if (success == true) {
                    NSData *data = [NSData dataWithBytes:imgdata length:imgsize];
                    NSBitmapImageRep *imageRep = [[NSBitmapImageRep alloc] initWithData:data];
                    NSImage *image = [[NSImage alloc] init];
                    [image addRepresentation:imageRep];
                    [weakSelf showImageView:image width:imageRep.pixelsWide height:imageRep.pixelsHigh];
                    free(imgdata);
                } else {
                    [weakSelf showTextView:[NSString stringWithUTF8String:msg]];
                }
            } else {
                [weakSelf mountImage];
            }
        });
    });

}

- (IBAction)clickedSnap:(id)sender {
    __typeof(self) __weak weakSelf = self;
    MBProgressHUD *hud = [MBProgressHUD showHUDAddedTo:self.window.contentView animated:YES];
    hud.dimBackground = YES;
    dispatch_async(dispatch_get_global_queue(DISPATCH_QUEUE_PRIORITY_LOW, 0), ^{
        BOOL result = false;
        if (weakSelf.imageView && weakSelf.imageView.image) {
            NSBitmapImageRep *imgRep = [[weakSelf.imageView.image representations] objectAtIndex:0];
            NSData *data = [imgRep representationUsingType:NSPNGFileType properties:nil];

            NSArray *dirs = NSSearchPathForDirectoriesInDomains(NSPicturesDirectory, NSUserDomainMask, YES);
            NSString *dir = [[dirs objectAtIndex:0] stringByAppendingPathComponent:@"xSnap"];
            if (![[NSFileManager defaultManager] fileExistsAtPath:dir]) {
                [[NSFileManager defaultManager] createDirectoryAtPath:dir withIntermediateDirectories:NO attributes:nil error:nil];
            }
            NSDateFormatter *formatter = [[NSDateFormatter alloc] init];
            [formatter setDateFormat:@"YYYYMMdd-hhmmssSSS"];
            NSString *date = [formatter stringFromDate:[NSDate date]];
            NSString *timeStamp = [[NSString alloc] initWithFormat:@"%@", date];
            NSString *path = [NSString stringWithFormat:@"%@/%@.png", dir, timeStamp];
//            NSLog(@"path: %@", path);
            result = [data writeToFile:path atomically:NO];
        }
        dispatch_async(dispatch_get_main_queue(), ^{
            if (result) {
                hud.mode = MBProgressHUDModeText;
                hud.labelText = NSLocalizedString(@"screenshot_save_success", nil);
                [hud hide:YES afterDelay:2];
            } else {
                hud.mode = MBProgressHUDModeText;
                hud.labelText = NSLocalizedString(@"screenshot_save_fail", nil);
                [hud hide:YES afterDelay:2];
            }
        });
    });
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
