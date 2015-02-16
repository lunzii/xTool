//
//  WindowController.m
//  aSnap
//
//  Created by olunx on 15/2/16.
//  Copyright (c) 2015年 olunx. All rights reserved.
//

#import "WindowController.h"
#import "adb_serviceProtocol.h"
#import <adb.h>
#import <adb_client.h>
#import <sysdeps.h>

@interface WindowController ()

@end

@implementation WindowController

- (void)windowDidLoad {
    [super windowDidLoad];

    _adbConnection = [[NSXPCConnection alloc] initWithServiceName:@"adb_service"];
    _adbConnection.remoteObjectInterface = [NSXPCInterface interfaceWithProtocol:@protocol(adb_serviceProtocol)];
    [_adbConnection remoteObjectProxyWithErrorHandler:^(NSError *error){
        NSLog(@"error: %@", error.description);
    }];
    [_adbConnection resume];

//
    // Implement this method to handle any initialization after your window controller's window has been loaded from its nib file.
}

- (IBAction)clickedSnap:(id)sender {
    NSLog(@"clickedSnap");

//    [[_adbConnection remoteObjectProxy] upperCaseString:@"test" withReply:^(NSString *reply){
//        NSLog(@"reply: %@", reply);
//    }];
    [[_adbConnection remoteObjectProxy] connectAdb];
    [_adbConnection invalidate];


//    [_adbConnection invalidate];
//    adb_sysdeps_init();
//    adb_trace_init();
//
//    transport_type ttype = kTransportAny;
//    char* serial = getenv("ANDROID_SERIAL");
//    int server_port = DEFAULT_ADB_PORT;
//    adb_set_transport(ttype, serial);
//    adb_set_tcp_specifics(server_port);
//
//    NSLog(@"Could not start adb server.");
//    int fd = adb_connect("host:start-server");
//    if(fd >= 0) {
//        NSLog(@"Server started.");
//    }else{
//        NSLog(@"Server did not start.");
//        return;
//    }
//
//    //    const char *service = "shell:ls /sdcard/Music/Download/李荣浩\\ -\\ 李白";
//
//    const char *service = "host:devices-l";
//    char *result = adb_query(service);
//    if(result != NULL){
//        NSLog(@"out:\n%@", [NSString stringWithUTF8String:result]);
//    }

//    const char *service = "shell:screencap /sdcard/tt.png";
//    int fd = adb_connect(service);
//    if(fd >= 0) {
//        read_and_dump(fd);
//    }
//    if(adb_status(fd)) {
//        adb_close(fd);
//    }

}

void read_and_dump(int fd)
{
    char buf[4096];
    int len;

    while(fd >= 0) {
        len = adb_read(fd, buf, 4096);
        if(len == 0) {
            break;
        }

        if(len < 0) {
            if(errno == EINTR) continue;
            break;
        }
        fwrite(buf, 1, len, stdout);
        fflush(stdout);
    }
}
@end
