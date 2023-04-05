<?php
function asset($path) {
    return base_url('public/' . ltrim($path, '/'));
}