/* 
 *
 *   File: mtp.h
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

#ifndef _MTP_H
#define _MTP_H

#include <mach/i386/boolean.h>

#ifdef  __cplusplus
extern "C" {
#endif

    enum MTP_ERROR {
        MTP_SUCCESS,
        MTP_NO_DEVICE,
        MTP_GENERAL_FAILURE,
        MTP_DEVICE_FULL,
        MTP_NO_MTP_DEVICE
    };

    enum MTP_PLAYLIST_INSTANCES {
        MTP_PLAYLIST_ALL_INSTANCES,
        MTP_PLAYLIST_FIRST_INSTANCE,
        MTP_PLAYLIST_LAST_INSTANCE
    };

#define MTP_DEVICE_SINGLE_STORAGE -1

    boolean_t AlbumErrorIgnore;

    typedef struct {
        char* file_extension;
        LIBMTP_filetype_t file_type;
    } MTP_file_ext_struct;

    uint32_t deviceConnect();
    uint32_t deviceDisconnect();
    void deviceProperties();
    void clearDeviceFiles(LIBMTP_file_t * filelist);
    void clearAlbumStruc(LIBMTP_album_t * albumlist);
    void clearDevicePlaylist(LIBMTP_playlist_t * playlist_list);
    void clearDeviceTracks(LIBMTP_track_t * tracklist);
    void deviceRescan();
    void filesUpateFileList();
    void filesRename(char* filename, uint32_t ObjectID);
    void filesAdd(char* filename);
    void filesDelete(char* filename, uint32_t objectID);
    void filesDownload(char* filename, uint32_t objectID);
    boolean_t fileExists(char* filename);
    uint32_t getFile(char* filename, uint32_t folderID);
    uint32_t folderAdd(char* foldername);
    void folderDelete(LIBMTP_folder_t* folderptr, uint32_t level);
    void folderDeleteChildrenFiles(uint32_t folderID);
    void folderDownload(char * foldername, uint32_t folderID, boolean_t isParent);
    boolean_t folderExists(char *foldername, uint32_t folderID);
    uint32_t getFolder(char *foldername, uint32_t folderID);
    void albumAddTrackToAlbum(LIBMTP_album_t* albuminfo, LIBMTP_track_t* trackinfo);
    void albumAddArt(uint32_t album_id, char* filename);
    void albumDeleteArt(uint32_t album_id);
    LIBMTP_filesampledata_t * albumGetArt(LIBMTP_album_t* selectedAlbum);
    void setDeviceName(char* devicename);
//    void buildFolderIDs(GSList **list, LIBMTP_folder_t * folderptr);
    uint32_t getParentFolderID(LIBMTP_folder_t *tmpfolder, uint32_t currentFolderID);
    LIBMTP_folder_t* getParentFolderPtr(LIBMTP_folder_t *tmpfolder, uint32_t currentFolderID);
    LIBMTP_folder_t* getCurrentFolderPtr(LIBMTP_folder_t *tmpfolder, uint32_t FolderID);
    LIBMTP_filetype_t find_filetype(const char * filename);
    char* find_filetype_ext(LIBMTP_filetype_t filetype);
    LIBMTP_devicestorage_t* getCurrentDeviceStoragePtr(int32_t StorageID);
    int setNewParentFolderID(uint32_t objectID, uint32_t folderID);

    // Playlist support.
    LIBMTP_playlist_t* getPlaylists(void);
    LIBMTP_track_t* getTracks(void);
    void playlistAdd(char* playlistname);
    void playlistDelete(LIBMTP_playlist_t * tmpplaylist);
    void playlistUpdate(LIBMTP_playlist_t * tmpplaylist);
    void playlistAddTrack(LIBMTP_playlist_t* playlist, LIBMTP_track_t* track);
    void playlistRemoveTrack(LIBMTP_playlist_t* playlist, LIBMTP_track_t* track, uint32_t instances);
    char* playlistImport(char * filename);
    void playlistExport(char * filename, LIBMTP_playlist_t * playlist);

    // Format device.
    void formatStorageDevice();

    // File operation helper.
    char* getFullFilename(uint32_t item_id);
    uint32_t getFileID(char* filename, boolean_t ignorepath);
    uint32_t getFolderID(LIBMTP_folder_t* folderptr, char* foldername);
    char* getFullFolderPath(uint32_t folderid);
//    GSList *filesSearch(gchar *searchstring, gboolean searchfiles, gboolean searchmeta);
//    void folderSearch(GPatternSpec *pspec, GSList **list, LIBMTP_folder_t* folderptr);

#ifdef  __cplusplus
}
#endif

#endif  /* _MTP_H */
