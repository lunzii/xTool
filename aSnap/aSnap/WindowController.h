//
//  WindowController.h
//  aSnap
//
//  Created by olunx on 15/2/16.
//  Copyright (c) 2015年 olunx. All rights reserved.
//

#import <Cocoa/Cocoa.h>

@interface WindowController : NSWindowController{
}

@property (strong, nonatomic) NSXPCConnection *adbConnection;

- (IBAction)clickedSnap:(id)sender;

@end
