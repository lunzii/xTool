/* 
 *
 *   File: mtp.c
 *
 *   Copyright (C) 2009-2013 Darran Kartaschew
 *
 *   This file is part of the gMTP package.
 *
 *   gMTP is free software; you can redistribute it and/or modify
 *   it under the terms of the BSD License as included within the
 *   file 'COPYING' located in the root directory
 *
 */

#include <libmtp.h>
#include <libgen.h>
#include <sys/stat.h>
#include <strings.h>
#include <string.h>
//#include <id3tag.h>
#include <stdio.h>
#include <unistd.h>
#include <stdbool.h>
#include <stdlib.h>
//#include <FLAC/all.h>

#include "mtp.h"
#include "device.h"


// Array with file extensions matched to internal libmtp file types;
// See find_filetype() for usage;
MTP_file_ext_struct file_ext[] = {
    {"wav", LIBMTP_FILETYPE_WAV},
    {"mp3", LIBMTP_FILETYPE_MP3},
    {"wma", LIBMTP_FILETYPE_WMA},
    {"ogg", LIBMTP_FILETYPE_OGG},
    {"mp4", LIBMTP_FILETYPE_MP4},
    {"wmv", LIBMTP_FILETYPE_WMV},
    {"avi", LIBMTP_FILETYPE_AVI},
    {"mpeg", LIBMTP_FILETYPE_MPEG},
    {"mpg", LIBMTP_FILETYPE_MPEG},
    {"asf", LIBMTP_FILETYPE_ASF},
    {"qt", LIBMTP_FILETYPE_QT},
    {"mov", LIBMTP_FILETYPE_QT},
    {"wma", LIBMTP_FILETYPE_WMA},
    {"jpg", LIBMTP_FILETYPE_JPEG},
    {"jpeg", LIBMTP_FILETYPE_JPEG},
    {"jfif", LIBMTP_FILETYPE_JFIF},
    {"tif", LIBMTP_FILETYPE_TIFF},
    {"tiff", LIBMTP_FILETYPE_TIFF},
    {"bmp", LIBMTP_FILETYPE_BMP},
    {"gif", LIBMTP_FILETYPE_GIF},
    {"pic", LIBMTP_FILETYPE_PICT},
    {"pict", LIBMTP_FILETYPE_PICT},
    {"png", LIBMTP_FILETYPE_PNG},
    {"wmf", LIBMTP_FILETYPE_WINDOWSIMAGEFORMAT},
    {"ics", LIBMTP_FILETYPE_VCALENDAR2},
    {"exe", LIBMTP_FILETYPE_WINEXEC},
    {"com", LIBMTP_FILETYPE_WINEXEC},
    {"bat", LIBMTP_FILETYPE_WINEXEC},
    {"dll", LIBMTP_FILETYPE_WINEXEC},
    {"sys", LIBMTP_FILETYPE_WINEXEC},
    {"txt", LIBMTP_FILETYPE_TEXT},
    {"aac", LIBMTP_FILETYPE_AAC},
    {"mp2", LIBMTP_FILETYPE_MP2},
    {"flac", LIBMTP_FILETYPE_FLAC},
    {"m4a", LIBMTP_FILETYPE_M4A},
    {"doc", LIBMTP_FILETYPE_DOC},
    {"xml", LIBMTP_FILETYPE_XML},
    {"xls", LIBMTP_FILETYPE_XLS},
    {"ppt", LIBMTP_FILETYPE_PPT},
    {"mht", LIBMTP_FILETYPE_MHT},
    {"jp2", LIBMTP_FILETYPE_JP2},
    {"jpx", LIBMTP_FILETYPE_JPX},
    {"bin", LIBMTP_FILETYPE_FIRMWARE},
    {"vcf", LIBMTP_FILETYPE_VCARD3},
    {"alb", LIBMTP_FILETYPE_ALBUM},
    {"pla", LIBMTP_FILETYPE_PLAYLIST}
};

static char* blank_ext = "";

// Ignore Album errors?

boolean_t AlbumErrorIgnore = false;

// ************************************************************************************************

/**
 * Attempt to connect to a device.
 * @return 0 if successful, otherwise error code.
 */
uint32_t deviceConnect() {
    int error;
    if (DeviceMgr.deviceConnected == true) {
        // We must be wanting to disconnect the device.
        return deviceDisconnect();
    } else {
        error = LIBMTP_Detect_Raw_Devices(&DeviceMgr.rawdevices, &DeviceMgr.numrawdevices);
        switch (error) {
            case LIBMTP_ERROR_NONE:
                break;
            case LIBMTP_ERROR_NO_DEVICE_ATTACHED:
                fprintf(stderr, "Detect: No raw devices found.\n");
                return MTP_GENERAL_FAILURE;
            case LIBMTP_ERROR_CONNECTING:
                fprintf(stderr, "Detect: There has been an error connecting. \n");
                return MTP_GENERAL_FAILURE;
            case LIBMTP_ERROR_MEMORY_ALLOCATION:
                fprintf(stderr, "Detect: Encountered a Memory Allocation Error. \n");
                return MTP_GENERAL_FAILURE;
            default:
                // Some other generic error, so let's exit.
                fprintf(stderr, "Detect: There has been an error connecting. \n");
                return MTP_GENERAL_FAILURE;
        }
        // We have at least 1 raw device, so we connect to the first device.
        if (DeviceMgr.numrawdevices > 1) {
//            DeviceMgr.rawdeviceID = displayMultiDeviceDialog();
//            if (!Preferences.use_alt_access_method) {
//                DeviceMgr.device = LIBMTP_Open_Raw_Device(&DeviceMgr.rawdevices[DeviceMgr.rawdeviceID]);
//            } else {
//                DeviceMgr.device = LIBMTP_Open_Raw_Device_Uncached(&DeviceMgr.rawdevices[DeviceMgr.rawdeviceID]);
//            }

        } else {
            // Connect to the first device.
//            if (!Preferences.use_alt_access_method) {
//                DeviceMgr.device = LIBMTP_Open_Raw_Device(&DeviceMgr.rawdevices[0]);
//            } else {
//                DeviceMgr.device = LIBMTP_Open_Raw_Device_Uncached(&DeviceMgr.rawdevices[0]);
//            }
            DeviceMgr.rawdeviceID = 0;
        }
        DeviceMgr.rawdeviceID = 0;
        DeviceMgr.device = LIBMTP_Open_Raw_Device(&DeviceMgr.rawdevices[DeviceMgr.rawdeviceID]);
        if (DeviceMgr.device == NULL) {
            fprintf(stderr, "Detect: Unable to open raw device?\n");
            LIBMTP_Dump_Errorstack(DeviceMgr.device);
            LIBMTP_Clear_Errorstack(DeviceMgr.device);
            DeviceMgr.deviceConnected = false;
            return MTP_GENERAL_FAILURE;
        }

        LIBMTP_Dump_Errorstack(DeviceMgr.device);
        LIBMTP_Clear_Errorstack(DeviceMgr.device);
        DeviceMgr.deviceConnected = true;

        // We have a successful device connect, but lets check for multiple storageIDs.
        if (DeviceMgr.device->storage == NULL) {
            fprintf(stderr, "Detect: No available Storage found on device?\n");
            LIBMTP_Dump_Errorstack(DeviceMgr.device);
            LIBMTP_Clear_Errorstack(DeviceMgr.device);
            deviceDisconnect();
            return MTP_GENERAL_FAILURE;
        }
        if (DeviceMgr.device->storage->next != NULL) {
            // Oops we have multiple storage IDs.
//            DeviceMgr.storagedeviceID = displayDeviceStorageDialog();
        } else {
            DeviceMgr.storagedeviceID = MTP_DEVICE_SINGLE_STORAGE;
        }
        DeviceMgr.devicename = NULL;
        DeviceMgr.manufacturername = NULL;
        DeviceMgr.modelname = NULL;
        DeviceMgr.serialnumber = NULL;
        DeviceMgr.deviceversion = NULL;
        //DeviceMgr.syncpartner = NULL;
        //DeviceMgr.sectime = NULL;
        DeviceMgr.devcert = NULL;
        DeviceMgr.Vendor = NULL;
        DeviceMgr.Product = NULL;
        DeviceMgr.devicestorage = NULL;

        return MTP_SUCCESS;
    }
}

// ************************************************************************************************

/**
 * Disconnect from the currently connected device.
 * @return 0 if successful, otherwise error code.
 */
uint32_t deviceDisconnect() {
    if (DeviceMgr.deviceConnected == false) {
        DeviceMgr.deviceConnected = false;
        return MTP_NO_DEVICE;
    } else {
        DeviceMgr.deviceConnected = false;
        LIBMTP_Release_Device(DeviceMgr.device);
        free(DeviceMgr.rawdevices);
        // Now clean up the dymanic data in struc that get's loaded when displaying the properties dialog.
        if (DeviceMgr.devicename != NULL) free(DeviceMgr.devicename);
        if (DeviceMgr.manufacturername != NULL) free(DeviceMgr.manufacturername);
        if (DeviceMgr.modelname != NULL) free(DeviceMgr.modelname);
        if (DeviceMgr.serialnumber != NULL) free(DeviceMgr.serialnumber);
        if (DeviceMgr.deviceversion != NULL) free(DeviceMgr.deviceversion);
        //if (DeviceMgr.syncpartner != NULL) free(DeviceMgr.syncpartner);
        //if (DeviceMgr.sectime != NULL) free(DeviceMgr.sectime);
        if (DeviceMgr.devcert != NULL) free(DeviceMgr.devcert);
        if (DeviceMgr.Vendor != NULL) free(DeviceMgr.Vendor);
        if (DeviceMgr.Product != NULL) free(DeviceMgr.Product);
        free(DeviceMgr.filetypes);
        return MTP_SUCCESS;
    }
}

// ************************************************************************************************

/**
 * Get the properties of the connected device. These properties are stored in 'DeviceMgr'.
 */

