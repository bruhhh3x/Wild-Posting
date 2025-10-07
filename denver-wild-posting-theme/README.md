# Denver Wild Posting WordPress Theme

A clean, modern WordPress theme for Denver Wild Posting company website featuring YouTube video integration and campaign management.

## Features

- **YouTube Video Integration**: Homepage hero section with embedded YouTube video
- **Campaign Management**: Custom post type for managing wild posting campaigns
- **Responsive Design**: Mobile-first approach with clean, modern styling
- **Custom Fields**: Meta boxes for campaign details (client, city, services, year, role, metrics)
- **WordPress Customizer**: Easy video settings management
- **SEO Friendly**: Proper WordPress structure and semantic HTML

## Installation

### Method 1: Upload via WordPress Admin

1. Zip the entire `denver-wild-posting-theme` folder
2. Go to WordPress Admin → Appearance → Themes
3. Click "Add New" → "Upload Theme"
4. Upload the zip file
5. Activate the theme

### Method 2: FTP Upload

1. Upload the `denver-wild-posting-theme` folder to `/wp-content/themes/`
2. Go to WordPress Admin → Appearance → Themes
3. Activate "Denver Wild Posting" theme

## Configuration

### Video Settings

1. Go to **Appearance → Customize → Homepage Video**
2. Set your YouTube Video ID (default: `VmiR0JEcaYc`)
3. Optionally set an MP4 video URL as fallback
4. Save changes

### Campaign Management

1. Go to **Campaigns** in the WordPress admin
2. Add new campaigns with:
   - Title and content
   - Featured image
   - Client name
   - City
   - Services
   - Year
   - Role description
   - Metrics

## File Structure

```
denver-wild-posting-theme/
├── style.css              # Main stylesheet with theme info
├── index.php              # Main template
├── header.php             # Header template
├── footer.php             # Footer template
├── functions.php          # Theme functions and features
├── single-campaign.php    # Single campaign template
├── archive-campaign.php   # Campaign archive template
├── assets/
│   ├── css/               # Additional CSS files
│   ├── js/
│   │   └── main.js        # Theme JavaScript
│   └── images/            # Theme images
└── README.md              # This file
```

## Customization

### Styling

The main styles are in `style.css`. Key classes:
- `.hero-section` - Homepage hero layout
- `.video-container` - Video wrapper styling
- `.nav-header` - Navigation styling
- `.campaign-card` - Campaign grid items

### JavaScript

Custom JavaScript in `assets/js/main.js` includes:
- Smooth scrolling for anchor links
- Image fallback handling
- Mobile menu functionality
- Lazy loading for images
- Video autoplay handling

### Adding New Features

1. **Custom Post Types**: Add to `functions.php`
2. **Custom Fields**: Use WordPress meta boxes or ACF
3. **Page Templates**: Create `page-{slug}.php` files
4. **Custom CSS**: Add to `style.css` or create child theme

## Video Integration

The theme supports two video sources:

1. **YouTube Video**: Set the YouTube ID in customizer
2. **MP4 Video**: Upload and set MP4 URL as fallback

The video will autoplay (muted) and loop on the homepage hero section.

## Browser Support

- Chrome (latest)
- Firefox (latest)
- Safari (latest)
- Edge (latest)
- Mobile browsers

## Requirements

- WordPress 5.0+
- PHP 7.4+
- Modern web browser

## Support

For theme support or customization requests, contact the development team.

## License

This theme is proprietary software for Worthy Wild Posting.
