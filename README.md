# Bengel compress
Bengel compress is a WordPress plugin designed to optimize and compress images on your website, improving load times and overall performance. It supports various image formats and offers customizable compression settings to suit your needs.

## Features
- Lossless and lossy image compression
- Bulk image optimization
- Automatic compression on upload (JPEG, PNG, GIF, WebP)
- Customizable compression levels

## TODO
- Implement a cloud-based compression option (Golang service on Serverless framework)
- Implement a local compression option (using PHP libraries like Imagick or GD)
- Implement full logging of:
- - Compressed images
- - Compression ratios (keep track of original vs compressed sizes)
- - Errors during compression
- Create a user-friendly settings page in the WordPress admin dashboard