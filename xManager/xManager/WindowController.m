//
//  WindowController.m
//  xManager
//
//  Created by olunx on 15/2/7.
//  Copyright (c) 2015年 olunx. All rights reserved.
//

#import <libmtp.h>
#import "WindowController.h"
#import "mtp.h"
#import "device.h"

@interface WindowController ()

@end

@implementation WindowController

- (void)windowDidLoad {
    [super windowDidLoad];
    
    // Implement this method to handle any initialization after your window controller's window has been loaded from its nib file.
}

- (IBAction)clickedConnect:(id)sender {
    // Initialise libmtp library
    LIBMTP_Init();
    
    DeviceMgr.deviceConnected = false;
//    LIBMTP_raw_device_t *rawDevice;
//    int numDev;
//    int error = LIBMTP_Detect_Raw_Devices(&rawDevice, &numDev);
//    switch (error) {
//        case LIBMTP_ERROR_NONE:
//            NSLog(@"Detect: No Error.");
//            break;
//        case LIBMTP_ERROR_NO_DEVICE_ATTACHED:
//            NSLog(@"Detect: No raw devices found.");
//            break;
//        case LIBMTP_ERROR_CONNECTING:
//            NSLog(@"Detect: There has been an error connecting. ");
//            break;
//        case LIBMTP_ERROR_MEMORY_ALLOCATION:
//            NSLog(@"Detect: Encountered a Memory Allocation Error.");
//            break;
//        default:
//            // Some other generic error, so let's exit.
//            NSLog(@"Detect: There has been an error connecting.");
//            break;
//    }

    deviceConnect();
//    if(MTP_SUCCESS == deviceConnect()){
//        NSLog(@"MTP_SUCCESS");
//    }else{
//        NSLog(@"MTP_FAIL");
//    }

}

@end
