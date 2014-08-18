Pure Text
=========

Pure text has two libraries, PureTextRender and PureCaptcha. The first one is able to render ASCII texts into monochrome BMP images and bitmap arrays, modifying them via rotations, scales and custom functions. 

The second one (PureCaptcha) can generate CAPTCHA images using the first class, without relying on any PHP extension.

Non of the classes require GD or Freetype, this means they work without GD and without freetype and ccan generate images from texts purely in PHP code.

This is achieved by generating and storing an ASCII bitmap in the class. More details in the source code.

