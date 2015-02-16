//
//  WindowController.m
//  aSnap
//
//  Created by olunx on 15/2/15.
//  Copyright (c) 2015年 olunx. All rights reserved.
//

#import "WindowController.h"

#import <MBProgressHUD.h>

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
    [self takeScreenShot];
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
    NSString *string = [self runCMD:@[@"devices", @"-l"]];
    NSLog(string);
//    if ([string rangeOfString:@"Status: Complete"].location != NSNotFound) {
//        result = YES;
//    }

    return result;
}

- (NSString *)runCMD:(NSArray *)args{
    NSString *cmd = [[NSBundle mainBundle] pathForResource:@"adb" ofType:nil];

    NSTask *task = [[NSTask alloc] init];
    task.launchPath = cmd;
    task.arguments = args;

    NSPipe *pipe = [NSPipe pipe];
    task.standardOutput = pipe;

    NSFileHandle *file = pipe.fileHandleForReading;
    [task launch];
    [task waitUntilExit];

    return [[NSString alloc] initWithData:file.readDataToEndOfFile
                                 encoding:NSUTF8StringEncoding];
}


- (void)takeScreenShot {
    __typeof(self) __weak weakSelf = self;
    MBProgressHUD *hud = [MBProgressHUD showHUDAddedTo:self.window.contentView animated:YES];
    hud.dimBackground = YES;
    hud.labelText = NSLocalizedString(@"screenshot_refreshing", nil);
    dispatch_async(dispatch_get_global_queue(DISPATCH_QUEUE_PRIORITY_LOW, 0), ^{
        BOOL success = NO;
        NSString *string = [self runCMD:@[@"shell", @"screencap", @"/sdcard/test.png"]];
        NSLog(string);
        string = [self runCMD:@[@"pull",  @"/sdcard/test.png", @"/Users/olunx/Pictures"]];
        NSLog(string);

        dispatch_async(dispatch_get_main_queue(), ^{
            [hud hide:YES];
            if([[NSFileManager defaultManager] fileExistsAtPath:@"/Users/olunx/Pictures/test.png"]){
                NSData *data = [NSData dataWithContentsOfFile:@"/Users/olunx/Pictures/test.png"];
                NSBitmapImageRep *imageRep = [[NSBitmapImageRep alloc] initWithData:data];
                NSImage *image = [[NSImage alloc] init];
                [image addRepresentation:imageRep];
                [weakSelf showImageView:image width:imageRep.pixelsWide height:imageRep.pixelsHigh];
            }
        });
    });

}

- (IBAction)clickedSnap:(id)sender {
    __typeof(self) __weak weakSelf = self;
    MBProgressHUD *hud = [MBProgressHUD showHUDAddedTo:self.window.contentView animated:YES];
    hud.dimBackground = YES;
    dispatch_async(dispatch_get_global_queue(DISPATCH_QUEUE_PRIORITY_LOW, 0), ^{
        BOOL result = NO;
        if (weakSelf.imageView && weakSelf.imageView.image) {
            NSBitmapImageRep *imgRep = [[weakSelf.imageView.image representations] objectAtIndex:0];
            NSData *data = [imgRep representationUsingType:NSPNGFileType properties:nil];

            NSPasteboard *pasteboard = [NSPasteboard generalPasteboard];
            [pasteboard declareTypes:[NSArray arrayWithObject:NSPasteboardTypePNG] owner:nil];
            result = [pasteboard setData:data forType:NSPasteboardTypePNG];
        }
        dispatch_async(dispatch_get_main_queue(), ^{
            if (result) {
                hud.mode = MBProgressHUDModeText;
                hud.labelText = NSLocalizedString(@"screenshot_snap_success", nil);
                [hud hide:YES afterDelay:2];
            } else {
                hud.mode = MBProgressHUDModeText;
                hud.labelText = NSLocalizedString(@"screenshot_snap_fail", nil);
                [hud hide:YES afterDelay:2];
            }
        });
    });
}

- (IBAction)clickedSave:(id)sender {
    __typeof(self) __weak weakSelf = self;
    MBProgressHUD *hud = [MBProgressHUD showHUDAddedTo:self.window.contentView animated:YES];
    hud.dimBackground = YES;
    dispatch_async(dispatch_get_global_queue(DISPATCH_QUEUE_PRIORITY_LOW, 0), ^{
        BOOL result = NO;
        if (weakSelf.imageView && weakSelf.imageView.image) {
            NSBitmapImageRep *imgRep = [[weakSelf.imageView.image representations] objectAtIndex:0];
            NSData *data = [imgRep representationUsingType:NSPNGFileType properties:nil];

            NSArray *dirs = NSSearchPathForDirectoriesInDomains(NSPicturesDirectory, NSUserDomainMask, YES);
            NSString *dir = [[dirs objectAtIndex:0] stringByAppendingPathComponent:@"aSnap"];
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
