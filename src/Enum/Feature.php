<?php

/*
 * BigBlueButton open source conferencing system - https://www.bigbluebutton.org/.
 *
 * Copyright (c) 2016-2023 BigBlueButton Inc. and by respective authors (see below).
 *
 * This program is free software; you can redistribute it and/or modify it under the
 * terms of the GNU Lesser General Public License as published by the Free Software
 * Foundation; either version 3.0 of the License, or (at your option) any later
 * version.
 *
 * BigBlueButton is distributed in the hope that it will be useful, but WITHOUT ANY
 * WARRANTY; without even the implied warranty of MERCHANTABILITY or FITNESS FOR A
 * PARTICULAR PURPOSE. See the GNU Lesser General Public License for more details.
 *
 * You should have received a copy of the GNU Lesser General Public License along
 * with BigBlueButton; if not, see <http://www.gnu.org/licenses/>.
 */

namespace BigBlueButton\Enum;

/**
 * @psalm-immutable
 */
class Feature extends Enum
{
    public const BREAKOUT_ROOMS = 'breakoutRooms';
    public const CAPTIONS = 'captions';
    public const CHAT = 'chat';
    public const DOWNLOAD_PRESENTATION_WITH_ANNOTATIONS = 'downloadPresentationWithAnnotations';
    public const EXTERNAL_VIDEOS = 'externalVideos';
    public const IMPORT_PRESENTATION_WITH_ANNOTATIONS_FROM_BREAKOUT_ROOMS = 'importPresentationWithAnnotationsFromBreakoutRooms';
    public const IMPORT_SHARED_NOTES_FROM_BREAKOUT_ROOMS = 'importSharedNotesFromBreakoutRooms';
    public const LAYOUTS = 'layouts';
    public const LEARNING_DASHBOARD = 'learningDashboard';
    public const POLLS = 'polls';
    public const SCREENSHARE = 'screenshare';
    public const SHARED_NOTES = 'sharedNotes';
    public const VIRTUAL_BACKGROUNDS = 'virtualBackgrounds';
    public const CUSTOM_VIRTUAL_BACKGROUNDS = 'customVirtualBackgrounds';
    public const LIVE_TRANSCRIPTION = 'liveTranscription';
    public const PRESENTATION = 'presentation';
    public const CAMERA_AS_CONTENT = 'cameraAsContent';
    public const SNAPSHOT_OF_CURRENT_SLIDE = 'snapshotOfCurrentSlide';
    public const DOWNLOAD_PRESENTATION_ORIGINAL_FILE = 'downloadPresentationOriginalFile';
    public const DOWNLOAD_PRESENTATION_CONVERTED_TO_PDF = 'downloadPresentationConvertedToPdf';
    public const TIMER = 'timer';

    /**
     * @deprecated Use Feature::IMPORT_PRESENTATION_WITH_ANNOTATIONS_FROM_BREAKOUT_ROOMS instead
     */
    public const IMPORT_PRESENTATION_WITHANNOTATIONS_FROM_BREAKOUTROOMS = 'importPresentationWithAnnotationsFromBreakoutRooms';

    /**
     * @deprecated Use Feature::IMPORT_SHARED_NOTES_FROM_BREAKOUT_ROOMS instead
     */
    public const IMPORT_SHARED_NOTES_FROM_BREAKOUTROOMS = 'importSharedNotesFromBreakoutRooms';
}
