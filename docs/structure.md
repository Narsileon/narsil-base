# Structure

Base provides shared Laravel behavior and UI used throughout the workspace.

```text
.  # Narsil Base root
├── database/  # Database files
│   └── migrations/  # Database migrations
├── docs/  # Documentation
│   ├── commands/  # Command documentation
│   │   ├── index.md  # Command index
│   │   ├── narsil-skills.md  # Narsil Skills check and fix commands
│   │   ├── phpunit.md  # PHPUnit commands
│   │   └── pint.md  # PHP formatting commands
│   ├── index.md  # Documentation index
│   └── structure.md  # Root structure reference
├── lang/  # Translations
│   ├── de/  # German translations
│   ├── en/  # English translations
│   └── fr/  # French translations
├── resources/  # Resources
│   ├── css/  # Stylesheets
│   ├── icons/  # Icon assets
│   │   └── fontawesome/  # Font Awesome icons
│   │       ├── brands/  # Font Awesome brand icons
│   │       ├── regular/  # Font Awesome regular icons
│   │       └── solid/  # Font Awesome solid icons
│   ├── js/  # Frontend code
│   │   ├── alpine/  # Alpine components
│   │   │   ├── form/  # Form behavior
│   │   │   └── sortable/  # Sortable behavior
│   │   ├── blocks/  # Frontend blocks
│   │   ├── components/  # Frontend components
│   │   ├── hooks/  # Lifecycle hooks
│   │   ├── lib/  # Frontend utilities
│   │   ├── pages/  # Frontend pages
│   │   │   ├── fortify/  # Fortify pages
│   │   │   ├── home/  # Home pages
│   │   │   ├── resources/  # Resource pages
│   │   │   └── users/  # User pages
│   │   ├── registries/  # Frontend registries
│   │   │   └── icons/  # Icon assets
│   │   ├── stores/  # Frontend state stores
│   │   └── types/  # Frontend types
│   └── views/  # Blade views
│       ├── components/  # Blade components
│       ├── layouts/  # Blade layouts
│       ├── livewire/  # Livewire components
│       │   └── input-relations/  # Input Relations files
│       └── pages/  # Frontend pages
│           ├── errors/  # Errors pages
│           ├── fortify/  # Fortify pages
│           ├── home/  # Home pages
│           └── resources/  # Resource pages
├── routes/  # HTTP routes
├── src/  # PHP source
│   ├── Actions/  # Application actions
│   ├── Casts/  # Model casts
│   ├── Console/  # Console commands
│   │   └── Commands/  # Console commands
│   ├── Contracts/  # Contract definitions
│   │   ├── Actions/  # Action contract definitions
│   │   │   ├── Roles/  # Role contract definitions
│   │   │   └── Users/  # User contract definitions
│   │   ├── Forms/  # Form contract definitions
│   │   │   └── Fortify/  # Fortify contract definitions
│   │   ├── Menus/  # Menu contract definitions
│   │   ├── Requests/  # Request contract definitions
│   │   │   └── Fortify/  # Fortify contract definitions
│   │   └── Resources/  # Resource contract definitions
│   ├── Database/  # Database files
│   │   ├── Factories/  # Eloquent model factories
│   │   └── Migrations/  # Database migrations
│   ├── Definitions/  # Resource definitions
│   ├── Enums/  # Application enums
│   ├── Helpers/  # Shared helper functions
│   ├── Http/  # HTTP request handling
│   │   ├── Collections/  # HTTP collection classes
│   │   ├── Controllers/  # HTTP controllers
│   │   │   ├── Fetch/  # Fetch controllers
│   │   │   ├── Fortify/  # Fortify controllers
│   │   │   ├── Models/  # Model controllers
│   │   │   ├── Settings/  # Settings controllers
│   │   │   ├── TanStackTables/  # Tan stack tables controllers
│   │   │   └── Users/  # User controllers
│   │   │       ├── Bookmarks/  # Bookmarks controllers
│   │   │       ├── Configurations/  # Configurations controllers
│   │   │       └── Sessions/  # Session controllers
│   │   ├── Data/  # HTTP data objects
│   │   │   ├── Forms/  # Form data objects
│   │   │   │   └── Inputs/  # Input data objects
│   │   │   └── TanStackTables/  # Tan stack tables data objects
│   │   │       └── Columns/  # Column data objects
│   │   ├── Middleware/  # HTTP middleware
│   │   └── Requests/  # HTTP requests
│   ├── Implementations/  # Contract implementations
│   │   ├── Actions/  # Action contract implementations
│   │   │   ├── Roles/  # Role contract implementations
│   │   │   └── Users/  # User contract implementations
│   │   ├── Events/  # Events contract implementations
│   │   ├── Forms/  # Form contract implementations
│   │   │   └── Fortify/  # Fortify contract implementations
│   │   ├── Menus/  # Menu contract implementations
│   │   ├── Requests/  # Request contract implementations
│   │   │   └── Fortify/  # Fortify contract implementations
│   │   ├── Resources/  # Resource contract implementations
│   │   └── Tables/  # Table contract implementations
│   ├── Interfaces/  # Application interfaces
│   ├── Jobs/  # Background jobs
│   ├── Livewire/  # Livewire components
│   ├── Models/  # Eloquent models
│   │   ├── Caches/  # Caches models
│   │   ├── Jobs/  # Jobs models
│   │   ├── Policies/  # Eloquent authorization models
│   │   ├── Storages/  # Storages models
│   │   └── Users/  # User models
│   ├── Observers/  # Eloquent model observers
│   ├── Policies/  # Eloquent model policies
│   ├── Providers/  # Laravel service providers
│   ├── Services/  # Application services
│   │   └── Ai/  # AI services
│   ├── Support/  # Application support code
│   │   └── Facades/  # Service facades
│   ├── Traits/  # Shared traits
│   │   └── Policies/  # Authorization traits
│   ├── Validation/  # Validation rules
│   └── View/  # Blade view components
│       └── Components/  # UI components
└── tests/  # PHP tests
    └── Feature/  # Feature tests
```
