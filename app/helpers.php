<?php

    function flash($message, $lavel = "info") {
        session()->flash('flash_message', $message);
        session()->flash('flash_message_level', $lavel);
    }

