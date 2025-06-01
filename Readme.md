# A Client App providing necessary crm and other functionalities to support your business

## Installation

1. Make sure you have PHP 8.2 or higher installed.
2. Install Composer if you haven't already:  
   https://getcomposer.org/download/
3. Run the following command in your project directory to install dependencies:
   ```bash
   composer install processton/setup
   ```
4. Update your users model to sync users with contacts
   ```php
   use Processton\Contact\Models\Contact;
   use Processton\AccessControll\Traits\HasAbility;
   use Processton\Locale\Traits\HasAddress;
   use Processton\Locale\Traits\HasCountry;
   use Processton\Contact\Traits\HasContact;

   use HasCountry, HasAddress, HasAbility, HasContact;

   protected static function booted()
   {
      static::created(function ($model) {
         Contact::registerUser($model);
      });
   }
   ```
5. Carefully place your middlewares In routes
   ```php
   use Processton\Org\Middleware\OrgMustBeInstalled;
   use Processton\Org\Middleware\OrgMustHaveBasicProfile;
   use Processton\Org\Middleware\OrgMustHaveFinancialProfile;
   use Processton\Contact\Middleware\UserMustHaveContact;
   use Processton\Company\Middleware\UserMustHaveCompany;
   ```
4. Publish config and assets.
5. Its not done yet you would need to follow [guidelines](doc/GuideLine.md) to integrate this application.

## Documentation

### Getting Started

- Review the [Installation](#installation) steps above.
- Explore the [list of provided namespaces](doc/ProvidedNameSpaces.md) for modular functionality .
- [Entities/Models included](doc/DatabaseModels.md) in this project
- Refer to inline code comments and type hints for usage guidance.

### Additional Resources

- [Composer Documentation](https://getcomposer.org/doc/)
- [PHP Official Documentation](https://www.php.net/docs.php)
- For further help, contact the project maintainers or open an issue.
