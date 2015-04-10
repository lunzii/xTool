//
//  WindowController.m
//  aSnap
//
//  Created by olunx on 15/2/15.
//  Copyright (c) 2015年 olunx. All rights reserved.
//

#import <CommonCrypto/CommonDigest.h>

#import "WindowController.h"
#import "TSTextField.h"

#import <MBProgressHUD.h>

@interface WindowController ()

@end

@implementation WindowController

- (void)windowDidLoad {
    [super windowDidLoad];
    self.contentView = self.window.contentView;

    [self clickedRefresh:nil];
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
//    NSLog(@"image width:%f height:%f", width, height);
    float scale = 2;
    if (height >= 2560) {
        scale = 4.0f;
    } else if (height >= 1280) {
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
}

- (void)removeImageView {
    if (self.imageView) {
        [self.imageView removeFromSuperview];
        self.imageView = nil;
    }
}

- (IBAction)clickedRefresh:(id)sender {
    if(self.checkProduct){
        switch (self.checkDevice){
            case DeviceFound:
                [self takeScreenShot];
                break;
            case DeviceNotAuthorize:
                [self showTextView:NSLocalizedString(@"device_status_not_authorize", nil)];
                break;
            case DeviceNotFound:
                [self showTextView:NSLocalizedString(@"device_status_not_found", nil)];
                break;
            case DeviceError:
                [self showTextView:NSLocalizedString(@"device_status_erro", nil)];
                break;
        }
    }
}

- (IBAction)clickedMore:(id)sender {
    [[NSWorkspace sharedWorkspace] openURL:[NSURL URLWithString:@"http://www.napflux.com/"]];
}

- (BOOL) checkProduct {
    BOOL result = NO;

    if(![[NSUserDefaults standardUserDefaults] boolForKey:@"product"]){
        if(_refreshCount < 2){
            _refreshCount++;
            return YES;
        }else{
            NSAlert *alert = [NSAlert alertWithMessageText:NSLocalizedString(@"product_alert_title", nil)
                                             defaultButton:NSLocalizedString(@"product_alert_btn_sure", nil)
                                           alternateButton:NSLocalizedString(@"product_alert_btn_cancel", nil)
                                               otherButton:nil
                                 informativeTextWithFormat:NSLocalizedString(@"product_alert_msg", nil)];

            TSTextField *email = [[TSTextField alloc] initWithFrame:NSMakeRect(0, 30, 300, 24)];
            email.placeholderString = NSLocalizedString(@"product_email", nil);
            TSTextField *key = [[TSTextField alloc] initWithFrame:NSMakeRect(0, 0, 300, 24)];
            key.placeholderString = NSLocalizedString(@"product_key", nil);
            NSView *view = [[NSView alloc] initWithFrame:NSMakeRect(0, 0, 300, 54)];
            [view addSubview:email];
            [view addSubview:key];
            [alert setAccessoryView:view];
            NSInteger button = [alert runModal];
            if (button == NSAlertDefaultReturn) {
                NSString *strEmail = [NSString stringWithFormat:@"%@+olunx%@", email.stringValue, @"2015"];
                NSString *strKey = key.stringValue.uppercaseString;
                NSString *productKey = [self md5String:strEmail];
                NSString *calKey = [productKey substringWithRange:NSMakeRange(4, productKey.length - 8)];
//                NSLog(@"strKey: %@", strKey);
//                NSLog(@"calKey: %@", calKey);

                if([calKey isEqualToString:strKey]){
                    result = YES;
                    [[NSUserDefaults standardUserDefaults] setBool:YES forKey:@"product"];
                    NSAlert *alert = [NSAlert alertWithMessageText:NSLocalizedString(@"product_success_title", nil)
                                                     defaultButton:NSLocalizedString(@"product_alert_btn_sure", nil)
                                                   alternateButton:nil
                                                       otherButton:nil
                                         informativeTextWithFormat:NSLocalizedString(@"product_success_msg", nil)];
                    alert.runModal;
                }else{
                    NSLog(@"Wrong product key.");
                }
            }
        }
    }else{
        result = YES;
    }

    return result;
}

- (NSString *)md5String:(NSString *)value {
    const char *cstr = [value UTF8String];
    unsigned char result[16];
    CC_MD5(cstr, strlen(cstr), result);

    return [NSString stringWithFormat:
            @"%02X%02X%02X%02X%02X%02X%02X%02X%02X%02X%02X%02X%02X%02X%02X%02X",
            result[0], result[1], result[2], result[3],
            result[4], result[5], result[6], result[7],
            result[8], result[9], result[10], result[11],
            result[12], result[13], result[14], result[15]
    ];
}

- (NSInteger)checkDevice {
    NSInteger result = DeviceNotFound;
    NSString *devices = [self runCMD:@[@"devices", @"-l"]];
//    NSLog(@"%@", devices);
    NSArray *array = [devices componentsSeparatedByString:@"\n"];
    if([array count] > 2){
        for(int i=1;i< [array count];i++){
            NSString *device = [array objectAtIndex:i];
//            NSLog(@"device: %@", device);
            if([device rangeOfString:@"unauthorized"].location != NSNotFound){
                result = DeviceNotAuthorize;
                break;
            }else if ([device rangeOfString:@"device"].location != NSNotFound) {
                result = DeviceFound;
                break;
            }
        }
    }
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

- (NSString *)getPicturePath{
    NSArray *dirs = NSSearchPathForDirectoriesInDomains(NSPicturesDirectory, NSUserDomainMask, YES);
    return [[dirs objectAtIndex:0] stringByAppendingPathComponent:@"aSnap"];
}

- (void)takeScreenShot {
    __typeof(self) __weak weakSelf = self;
    MBProgressHUD *hud = [MBProgressHUD showHUDAddedTo:self.window.contentView animated:YES];
    hud.dimBackground = YES;
    hud.labelText = NSLocalizedString(@"screenshot_refreshing", nil);
    dispatch_async(dispatch_get_global_queue(DISPATCH_QUEUE_PRIORITY_LOW, 0), ^{
        NSString *string = [self runCMD:@[@"shell", @"screencap", @"/sdcard/.asnap.png"]];
//        NSLog(string);
        NSString *storeFile = [[weakSelf getPicturePath] stringByAppendingPathComponent:@".asnap.png"];
//        NSLog(storeFile);
        string = [self runCMD:@[@"pull",  @"/sdcard/.asnap.png", storeFile]];
//        NSLog(string);
        dispatch_async(dispatch_get_main_queue(), ^{
            [hud hide:YES];
            if([[NSFileManager defaultManager] fileExistsAtPath:storeFile]){
                NSData *data = [NSData dataWithContentsOfFile:storeFile];
                NSBitmapImageRep *imageRep = [[NSBitmapImageRep alloc] initWithData:data];
                NSImage *image = [[NSImage alloc] init];
                [image addRepresentation:imageRep];
                [weakSelf showImageView:image width:imageRep.pixelsWide height:imageRep.pixelsHigh];
            }else{
                [self showTextView:NSLocalizedString(@"device_screenshot_fail", nil)];
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

            NSString *dir = [weakSelf getPicturePath];
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
