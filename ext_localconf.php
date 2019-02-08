<?php defined('TYPO3_MODE') || die();

call_user_func(function () {
    if (TYPO3_MODE === 'BE') {
        $GLOBALS['TYPO3_CONF_VARS']['SC_OPTIONS']['extbase']['commandControllers']['cs_file_meta_fill'] =
            \Clickstorm\CsFileMetaFill\Command\UpdateMetadataCommandController::class;

        $signalSlotDispatcher = \TYPO3\CMS\Core\Utility\GeneralUtility::makeInstance(\TYPO3\CMS\Extbase\SignalSlot\Dispatcher::class);
        // Convert images on processing files
        $signalSlotDispatcher->connect(
            \TYPO3\CMS\Core\Resource\ResourceStorage::class,
            \TYPO3\CMS\Core\Resource\Service\FileProcessingService::SIGNAL_PostFileProcess,
            \Clickstorm\CsFileMetaFill\Hooks\File::class,
            'postFileProcess'
        );
    }
});
