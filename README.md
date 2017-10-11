Optimal settings after default XAMPP install:

 * In `php.ini`, set `upload_max_filesize=40M` (so video snapshots of e.g. 2160p videos can be saved, default is 2MB, but PNG snapshots go over 20MB at times)
 * In `php.ini`, set `post_max_size=40M`
 * Restart Apache in XAMPP Control Panel

Todo:

 * Convert PNG via e.g. Emscripten to JPG, so the upload is much smaller?
 * * Pro: way less upload, from e.g. 2MB PNG files to 300kb JPG files
 * * Contra: more complexity
 
Could also be converted server side via PHP...



Start nodejs streaming server:

	`node stream.js`
	
	
Keyboard shortcuts:

 * f = fullscreen toggle
 * b = boss key (aka `video.remove()`)
 * s = take snapshot from video and upload to `saveimage.php`, which creates file in `thumbs` folder
 * m = mute/unmute toggle
 * Array right = +5 seconds to video time
 * Array left = -5 seconds to video time
 * * Modifiers: Alt = 1 second, Shift = one frame, which is fixed at 1/30 seconds, Ctrl = jump 1 minute
 * Space = play/pause toggle
 * Array up/down: increase/decrease volume
 
Mouse shortcuts:
 * Double click = fullscreen toggle
 * Single click = play/pause toggle