//
//  ImageMounter.h
//  xSnap
//
//  Created by olunx on 15/1/27.
//  Copyright (c) 2015年 olunx. All rights reserved.
//

#import <Foundation/Foundation.h>


@interface ImageMounter : NSObject

+(BOOL) mount:(const char *)image;

@end