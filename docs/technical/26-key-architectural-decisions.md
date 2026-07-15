# 26. Key Architectural Decisions

1. Use Laravel Blade and Livewire, not a full SPA.
2. Use Filament for the CMS and admin operations.
3. Use MySQL as the primary source of truth.
4. Keep public layouts application-controlled while allowing administrators to control content.
5. Do not implement an unrestricted page builder in the initial version.
6. Treat Product as a catalog module, not e-commerce.
7. Manage uploaded media through Laravel Filesystem and the admin panel.
8. Treat SEO, performance, mobile UX, and security as core requirements.
9. Keep architecture pragmatic; introduce abstractions only when they solve a demonstrated problem.
10. Evaluate every new feature by its effect on conversion, admin operations, delivery risk, and maintenance cost.
