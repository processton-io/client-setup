
 ## Package for Locale Configurations with Currency Support
 
  This package provides comprehensive locale configurations, including currency settings. 
  It organizes data hierarchically:
 - **Regions** contain multiple countries.
 - **Countries** contain multiple cities.
 - **Cities** contain multiple zones.
 
 Additionally, it includes functionality for managing addresses, with a backend powered by Filament. 
 * While the package provides a basic seeder for initial setup, users are currently required to manually add countries, cities, and zones for detailed configurations.
 ### Features:
 #### Middleware:
    - `MustHaveCity`: Ensures users are associated with a city.
    - `MustHaveAddress`: Ensures users have a valid address.
    - Address management with Filament-based backend.
 
 ### Pending Work:
 - [ ] Add middleware for region selection.
 - [ ] Integrate map support for region selection pages.
 - [ ] Implement support for advanced graphs and visualizations.
 - [ ] Add a scheduled task to process addresses using a third-party API.
 - [ ] Add "Import Sample Data" buttons to provide import functionality, allowing users to import predefined data instead of manual seeding.
 
