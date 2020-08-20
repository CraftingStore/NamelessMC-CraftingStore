# Nameless CraftingStore
Integrate CraftingStore into your NamelessMC website

## Requirements
- NamelessMC version 2 pre-release 7+
- PHP 7.2 or higher, we do not support older versions, as those do not get any security updates from PHP.
- [CraftingStore](https://craftingstore.net)

## Installation
1. Upload the contents of the **upload** directory into your NamelessMC installation's directory
2. Activate the module in the StaffCP -> Modules tab
3. Configure the module in the StaffCP -> CraftingStore tab
4. Run an initial synchronization in the StaffCP -> CraftingStore -> Force Sync

## Developer notice
The module does not use namespaces, auto loading, dependency injection or anything cool, as the base NamelessMC product does not use those. It also requires some global variables to be accessible outside of our classes. Our code cannot always use classes, and uses global variables sometimes as this is required for the module to work correctly.