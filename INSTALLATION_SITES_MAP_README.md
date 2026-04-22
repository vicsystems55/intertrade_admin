# Installation Sites Map - Documentation

## Overview
The Installation Sites Map is an interactive mapping system that displays solar and cold chain installation locations across Nigeria. It includes filtering, Excel data import/export functionality, and a modern user interface.

## Features

### 1. Interactive Map
- Displays Nigerian map with Leaflet.js
- Color-coded markers:
  - **Green**: Solar projects
  - **Blue**: Cold chain projects
- Click markers to see detailed information
- Pan and zoom controls

### 2. Filtering
- Filter installations by type:
  - Show All
  - Solar Projects Only
  - Cold Chain Projects Only
- Real-time map updates

### 3. Statistics Dashboard
- Total installations count
- Solar projects count
- Cold Chain projects count
- Live updates as data changes

### 4. Excel Import
- Upload Excel files with installation data
- Supported formats: XLSX, XLS, CSV
- File size limit: 10MB
- Required columns:
  1. Project Name
  2. Location Name
  3. Latitude
  4. Longitude
  5. Project Type (solar/cold_chain)
  6. Description (optional)
  7. State (optional)
  8. Local Government (optional)
  9. Installation Date (optional)

### 5. Export Functionality
- Export map as PNG image
- Download current installations as Excel file
- Respects current filter settings

### 6. Fullscreen Mode
- Expand map to fullscreen for better viewing
- Exit fullscreen with ESC key or button

## Database Schema

### InstallationLocation Table
```sql
- id (Primary Key)
- project_name (string)
- location_name (string)
- latitude (decimal 10,8)
- longitude (decimal 11,8)
- project_type (enum: 'solar', 'cold_chain')
- description (text, nullable)
- state (string, nullable)
- local_government (string, nullable)
- installation_date (date, nullable)
- status (string, default: 'active')
- created_at (timestamp)
- updated_at (timestamp)
```

## API Endpoints

All endpoints require authentication with SANCTUM middleware.

### Get All Locations
```
GET /api/installation-locations
Query Parameters:
- project_type: 'solar' | 'cold_chain' | 'all' (default: all)
```

### Get Statistics
```
GET /api/installation-locations/statistics
Response:
{
  "total": 0,
  "solar": 0,
  "cold_chain": 0
}
```

### Create Location
```
POST /api/installation-locations
Body:
{
  "project_name": "string",
  "location_name": "string",
  "latitude": float,
  "longitude": float,
  "project_type": "solar|cold_chain",
  "description": "string (optional)",
  "state": "string (optional)",
  "local_government": "string (optional)",
  "installation_date": "YYYY-MM-DD (optional)"
}
```

### Update Location
```
PATCH /api/installation-locations/{id}
Body: Same as create
```

### Delete Location
```
DELETE /api/installation-locations/{id}
Note: Sets status to 'inactive' instead of hard delete
```

### Upload Excel
```
POST /api/installation-locations/upload-excel
Form Data:
- file: multipart file (xlsx/xls/csv, max 10MB)
```

### Export Excel
```
GET /api/installation-locations/export-excel
Query Parameters:
- project_type: 'solar' | 'cold_chain' | 'all' (default: all)
```

## Sample Excel Template

Create an Excel file with the following structure:

| Project Name | Location Name | Latitude | Longitude | Project Type | Description | State | Local Government | Installation Date |
|:---|:---|:---|:---|:---|:---|:---|:---|:---|
| Lekki Solar Farm | Lekki Peninsula | 6.4319 | 3.5296 | solar | Solar facility | Lagos | Lekki | 2023-06-15 |
| Cold Storage Lagos | Apapa | 6.4136 | 3.5297 | cold_chain | Pharma storage | Lagos | Apapa | 2023-05-20 |

## Usage Instructions

### Viewing the Map
1. Navigate to `/admin/installation_sites`
2. The map loads automatically with all active installations
3. Zoom and pan to explore different regions

### Filtering Installations
1. Use the filter options on the left sidebar
2. Select "Show All", "Solar Projects", or "Cold Chain Projects"
3. Map updates instantly

### Adding Locations via Excel
1. Prepare your Excel file with the required format
2. Click the upload area (or drag and drop)
3. Select your file
4. Wait for upload confirmation
5. Map refreshes with new data

### Exporting Map
1. Click the "Export" button (green)
2. Wait for image generation
3. PNG file downloads automatically

### Fullscreen View
1. Click the "Fullscreen" button (blue)
2. Map expands to full screen
3. Press ESC or click button again to exit

## Installation & Setup

### Database Migration
```bash
php artisan migrate
```

### Seed Sample Data
```bash
php artisan db:seed --class=InstallationLocationSeeder
```

### Clear Cache (if needed)
```bash
php artisan cache:clear
php artisan config:cache
```

## Leaflet Map Library
- **Version**: 1.9.4
- **Source**: CDN (cdnjs.cloudflare.com)
- **Tile Provider**: OpenStreetMap

## Dependencies
- Laravel 8+
- PHPOffice/PhpSpreadsheet (via Maatwebsite/Excel)
- Leaflet.js 1.9.4
- Tailwind CSS (for styling)

## Troubleshooting

### Map Not Loading
- Check browser console for CORS errors
- Verify internet connection for CDN resources
- Clear browser cache

### Upload Not Working
- Verify file format (XLSX, XLS, or CSV)
- Check file size (max 10MB)
- Ensure all required columns are present

### No Data Showing
- Check that installations exist in database
- Verify user has authentication token
- Check filter settings

## Security Notes
- All API endpoints require SANCTUM authentication
- File uploads are validated for type and size
- SQL injection protection via Laravel ORM
- CSRF token required for form submissions

## Future Enhancements
- Real-time data updates with WebSockets
- Project status tracking
- Performance metrics and analytics
- Bulk operations
- Custom map layers
- Street view integration
- Installation timeline
