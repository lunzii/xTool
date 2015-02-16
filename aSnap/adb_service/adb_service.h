//
//  adb_service.h
//  adb_service
//
//  Created by olunx on 15/2/16.
//  Copyright (c) 2015年 olunx. All rights reserved.
//

#import <Foundation/Foundation.h>
#import "adb_serviceProtocol.h"

// This object implements the protocol which we have defined. It provides the actual behavior for the service. It is 'exported' by the service to make it available to the process hosting the service over an NSXPCConnection.
@interface adb_service : NSObject <adb_serviceProtocol>

@end
