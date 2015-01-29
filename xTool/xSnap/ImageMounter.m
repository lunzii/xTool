//
//  ImageMounter.m
//  xSnap
//
//  Created by olunx on 15/1/27.
//  Copyright (c) 2015年 olunx. All rights reserved.
//

#import "ImageMounter.h"

#include <stdlib.h>
#include <stdio.h>
#include <string.h>
#include <getopt.h>
#include <errno.h>
#include <libgen.h>
#include <time.h>
#include <sys/time.h>
#include <inttypes.h>

#include <libimobiledevice/libimobiledevice.h>
#include <libimobiledevice/lockdown.h>
#include <libimobiledevice/mobile_image_mounter.h>

@implementation ImageMounter {

}

static ssize_t mim_upload_cb(void* buf, size_t size, void* userdata)
{
    return fread(buf, 1, size, (FILE*)userdata);
}

+(BOOL) mount:(const char *)image{
    BOOL mountResult = NO;

    const char *image_path = image;
    char *image_sig_path = NULL;
    asprintf(&image_sig_path, "%s.signature", image_path);
    char *image_type = strdup("Developer");

    struct stat fst;
    stat(image_path, &fst);
    size_t image_size = fst.st_size;

    char *target_name = strdup("PublicStaging/staging.dimage");
    char *mount_name = NULL;
    asprintf(&mount_name, "/private/var/mobile/Media/%s", target_name);

    idevice_t device = NULL;
    lockdownd_client_t lckd = NULL;
    mobile_image_mounter_client_t mim = NULL;
    lockdownd_service_descriptor_t service = NULL;

    char *udid = NULL;
    if (IDEVICE_E_SUCCESS != idevice_new(&device, udid)) {
        printf("No device found, is it plugged in?\n");
        goto leave;
    }
    free(udid);

    if (LOCKDOWN_E_SUCCESS != lockdownd_client_new_with_handshake(device, &lckd, "ideviceimagemounter")) {
        printf("ERROR: Could not connect to lockdown.\n");
        goto leave;
    }

    lockdownd_start_service(lckd, "com.apple.mobile.mobile_image_mounter", &service);
    if(MOBILE_IMAGE_MOUNTER_E_SUCCESS != mobile_image_mounter_new(device, service, &mim)){
        printf("ERROR: Could not connect to mobile_image_mounter!\n");
        goto leave;
    }
    if (service) {
        lockdownd_service_descriptor_free(service);
        service = NULL;
    }
    if(lckd){
        lockdownd_client_free(lckd);
        lckd = NULL;
    }

    mobile_image_mounter_error_t err;
    plist_t result = NULL;

    char sig[8192];
    size_t sig_length = 0;
    FILE *f = fopen(image_sig_path, "rb");
    sig_length = fread(sig, 1, sizeof(sig), f);
    fclose(f);

    f = fopen(image_path, "rb");
    err = mobile_image_mounter_upload_image(mim, image_type, image_size, sig, sig_length, mim_upload_cb, f);
    if (err == MOBILE_IMAGE_MOUNTER_E_SUCCESS) {
        printf("Upload succeed.\n");
    }else{
        printf("Upload failed.\n");
    }
    fclose(f);

    printf("Mounting...\n");
    err = mobile_image_mounter_mount_image(mim, mount_name, sig, sig_length, image_type, &result);
    if (err == MOBILE_IMAGE_MOUNTER_E_SUCCESS) {
        printf("Mount succeed.\n");
        mountResult = YES;
    }else{
        printf("Mount failed.\n");
    }
    if (result) {
        plist_free(result);
    }

    /* perform hangup command */
    mobile_image_mounter_hangup(mim);
    /* free client */
    mobile_image_mounter_free(mim);

leave:
    if (lckd) {
        lockdownd_client_free(lckd);
    }
    idevice_free(device);

    if(image_type){
        free(image_type);
    }
    if(target_name){
        free(target_name);
    }
    if(mount_name){
        free(mount_name);
    }
//    if (image_path)
//        free(image_path);
    if (image_sig_path)
        free(image_sig_path);

    return mountResult;
}
@end