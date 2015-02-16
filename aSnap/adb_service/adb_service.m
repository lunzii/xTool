//
//  adb_service.m
//  adb_service
//
//  Created by olunx on 15/2/16.
//  Copyright (c) 2015年 olunx. All rights reserved.
//

#import "adb_service.h"
#import <adb.h>
#import <adb_client.h>
#import <sysdeps.h>

@implementation adb_service

// This implements the example protocol. Replace the body of this class with the implementation of this service's protocol.
- (void)upperCaseString:(NSString *)aString withReply:(void (^)(NSString *))reply {
    NSLog(@"upperCaseString");
    NSString *response = [aString uppercaseString];
    reply(response);
}

- (void)connectAdb {
    adb_sysdeps_init();
    adb_trace_init();

    transport_type ttype = kTransportAny;
    char* serial = getenv("ANDROID_SERIAL");
    int server_port = DEFAULT_ADB_PORT;
    adb_set_transport(ttype, serial);
    adb_set_tcp_specifics(server_port);

    NSLog(@"Could not start adb server.");
    int fd = adb_connect("host:start-server");
    if(fd >= 0) {
        NSLog(@"Server started.");
    }else{
        NSLog(@"Server did not start.");
        return;
    }
}

@end
