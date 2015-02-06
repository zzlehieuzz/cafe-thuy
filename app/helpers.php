<?php

function scaleImageHeight($file, $height) {
    return ApiUtil::scaleHeight($file, $height);
}

function scaleImageWidth($file, $width) {
    return ApiUtil::scaleWidth($file, $width);
}


