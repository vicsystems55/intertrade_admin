# Installation Sites Map - Quick Start Guide

## ✨ Features Implemented

### 1. **Interactive Nigerian Map**
- Displays installation locations with color-coded markers
- Green markers for Solar projects
- Blue markers for Cold Chain projects
- Click on markers to view detailed information

### 2. **Real-time Filtering**
- Filter by project type (All, Solar, Cold Chain)
- Live map updates based on filter selection
- Automatic zoom adjustment to visible markers

### 3. **Statistics Dashboard**
- Total installations count
- Solar projects count
- Cold Chain projects count
- Auto-updates as data changes

### 4. **Excel Import/Export**
- Upload Excel files with installation data
- Supports XLSX, XLS, and CSV formats
- Drag-and-drop upload support
- File size limit: 10MB
- Auto-refresh map after upload
- Export all data as Excel file

### 5. **Map Export**
- Export map view as PNG image
- Download with timestamp

### 6. **Fullscreen Mode**
- Expand map to fullscreen view
- Better viewing for presentations/demos
- Press ESC to exit fullscreen

### 7. **Modern UI**
- Built with Bootstrap 5
- Responsive design
- Toast notifications for user feedback
- Clean, professional appearance

---

## 🚀 Getting Started

### Database Setup
The migration has already been executed. To reset and seed sample data:

```bash
php artisan migrate:fresh --seed --seeder=InstallationLocationSeeder
```

### Sample Data
The seeder includes 10 sample installations:
- **5 Solar Projects** across Lagos, Abuja, Oyo, Rivers, and Kano
- **5 Cold Chain Projects** across Lagos, Enugu, Kaduna, Edo, and Bauchi

### Access the Map
Navigate to: `/admin/installation_sites`

---

## 📁 Files Created/Modified

### New Files:
1. **Model**: `app/Models/InstallationLocation.php`
2. **Migration**: `database/migrations/2026_04_22_171946_create_installation_locations_table.php`
3. **Seeder**: `database/seeders/InstallationLocationSeeder.php`
4. **API Controller**: `app/Http/Controllers/Api/InstallationLocationController.php`
5. **Export Class**: `app/Exports/InstallationLocationsExport.php`
6. **Blade View**: `resources/views/superadmin_dashboard/installation_sites.blade.php`
7. **Documentation**: `INSTALLATION_SITES_MAP_README.md`
8. **Template Guide**: `EXCEL_UPLOAD_TEMPLATE.md`

### Modified Files:
1. **Controller**: `app/Http/Controllers/SuperAdminPageController.php`
2. **API Routes**: `routes/api.php`

---

## 📊 API Endpoints

All endpoints require authentication (SANCTUM middleware).

### **GET** `/api/installation-locations`
Get all active installations with optional filtering
```
Query: ?project_type=solar|cold_chain|all
```

### **GET** `/api/installation-locations/statistics`
Get count statistics for all project types

### **POST** `/api/installation-locations`
Create a new installation location

### **PATCH** `/api/installation-locations/{id}`
Update an existing location

### **DELETE** `/api/installation-locations/{id}`
Soft delete a location (sets status to inactive)

### **POST** `/api/installation-locations/upload-excel`
Upload Excel file with locations

### **GET** `/api/installation-locations/export-excel`
Download all locations as Excel file

---

## 📋 Excel Upload Format

Required columns (in order):
1. **Project Name** - String
2. **Location Name** - String
3. **Latitude** - Decimal (e.g., 6.4319)
4. **Longitude** - Decimal (e.g., 3.5296)
5. **Project Type** - "solar" or "cold_chain"
6. **Description** - Text (optional)
7. **State** - State name (optional)
8. **Local Government** - LGA name (optional)
9. **Installation Date** - YYYY-MM-DD (optional)

---

## 🔧 Troubleshooting

### Map Not Loading
- Check browser console for errors
- Verify internet connection (CDN resources)
- Clear browser cache

### Authentication Errors
- Ensure user is logged in
- Check SANCTUM token if using API directly
- CSRF token in meta tag is auto-included

### Upload Fails
- Verify file format (XLSX, XLS, CSV)
- Check file size < 10MB
- Ensure all required columns present

---

## 🎨 UI Components

- **Bootstrap 5** - Primary styling framework
- **Boxicons** - Icons (bx- prefix)
- **Leaflet.js** - Interactive maps
- **Toast Notifications** - User feedback

---

## 📝 Database Schema

```sql
CREATE TABLE installation_locations (
    id BIGINT PRIMARY KEY AUTO_INCREMENT,
    project_name VARCHAR(255) NOT NULL,
    location_name VARCHAR(255) NOT NULL,
    latitude DECIMAL(10, 8) NOT NULL,
    longitude DECIMAL(11, 8) NOT NULL,
    project_type ENUM('solar', 'cold_chain') DEFAULT 'solar',
    description LONGTEXT NULL,
    state VARCHAR(255) NULL,
    local_government VARCHAR(255) NULL,
    installation_date DATE NULL,
    status VARCHAR(50) DEFAULT 'active',
    created_at TIMESTAMP,
    updated_at TIMESTAMP
);
```

---

## 🔐 Security Features

- SANCTUM API authentication
- CSRF protection
- SQL injection prevention (Eloquent ORM)
- File type validation
- File size limits
- Soft deletes (maintains data integrity)

---

## 🌍 Map Coordinates

The map is centered on Nigeria's geographic center:
- **Latitude**: 9.0765° N
- **Longitude**: 7.3986° E
- **Initial Zoom**: 6

---

## 📱 Responsive Design

- Mobile: Single column layout
- Tablet: 2-column layout
- Desktop: 3-column layout with sidebar
- All components fully responsive

---

## Future Enhancements

- [ ] Real-time WebSocket updates
- [ ] Performance metrics integration
- [ ] Custom map layers
- [ ] Street view integration
- [ ] Project timeline view
- [ ] Bulk operations
- [ ] Advanced filtering options
- [ ] Export to multiple formats (PDF, CSV, JSON)

---

## Support

For issues or questions, check:
1. Browser console for errors
2. Laravel error logs: `storage/logs/laravel.log`
3. API response status codes
4. Network tab for CORS issues

---

**Map Last Updated**: April 22, 2026
**Status**: ✅ Production Ready
