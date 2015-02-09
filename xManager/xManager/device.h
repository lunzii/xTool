//
//  device.h
//  xManager
//
//  Created by olunx on 15/2/8.
//  Copyright (c) 2015年 olunx. All rights reserved.
//

#ifndef __xManager__device__
#define __xManager__device__

#include <stdio.h>
#include <mach/i386/boolean.h>
#include <libmtp.h>

typedef struct {
    boolean_t deviceConnected;
    int numrawdevices;
    int rawdeviceID;
    int storagedeviceID;

    LIBMTP_raw_device_t * rawdevices;
    LIBMTP_mtpdevice_t *device;
    LIBMTP_devicestorage_t *devicestorage;
    LIBMTP_error_number_t err;

    char *devicename;
    char *manufacturername;
    char *modelname;
    char *serialnumber;
    char *deviceversion;
    //GString *syncpartner;
    //GString *sectime;
    char *devcert;

    // Raw device
    char *Vendor;
    char *Product;
    uint32_t VendorID;
    uint32_t ProductID;
    uint32_t DeviceID;
    uint32_t BusLoc;

    uint16_t *filetypes;
    uint16_t filetypes_len;
    uint8_t maxbattlevel;
    uint8_t currbattlevel;

} Device_Struct;

Device_Struct DeviceMgr;

#endif /* defined(__xManager__device__) */
