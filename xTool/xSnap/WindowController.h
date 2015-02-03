//
//  WindowController.h
//  xSnap
//
//  Created by olunx on 15/1/27.
//  Copyright (c) 2015年 olunx. All rights reserved.
//

#import <Cocoa/Cocoa.h>
#import "ViewController.h"

@interface WindowController : NSWindowController

@property (weak) IBOutlet NSToolbarItem *iconRefresh;

@property (strong, nonatomic) IBOutlet NSView *contentView;
@property (strong, nonatomic) IBOutlet NSTextView *textView;
@property (strong, nonatomic) IBOutlet NSImageView *imageView;

- (IBAction)clickedRefresh:(id)sender;
- (IBAction)clickedSnap:(id)sender;
- (IBAction)clickedSave:(id)sender;
- (IBAction)clickedMore:(id)sender;

@end
