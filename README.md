# Dogman Pet World

## Commands

- ```sail artisan create:admin-user``` -> Create a new Filament custom admin user user custom
- ```alias sail='sh $([ -f sail ] && echo sail || echo vendor/bin/sail)'``` -> command for configuring shell alias from ```./vendor/bin/sail``` to ```sail up```
- ```php artisan make:filament-relation-manager ClientResource Employee user_id``` -> command for relating  UserResource to Employee

## TO DO List

1. Admin and employee access roles ✅
2. Work on how disabled fields work ✅
3. Admin can only register employees ✅
4.  proper text editor for textareas ✅
5. employees can only regeister clients ✅
6. Some Pet fields in the tables are blank ✅
7. formating the relation manager to do it work. ✅
8. Client can sign in with client id and password. ✅
9. Properly format the form fields and table fields ✅
10. Enums for static data like default password and all ✅
11. work on the autorizations form admin and regular models ✅
12. create relationship manager between petResource and pet_activity_schedule then with employee and pet activity schedule to view all activity under an employee ✅
13. saving images and profile pictures of users and employees should be implemented
14. the "client_id",in the user model not being input into the filament form so i will work debugging the update fields.
15. employee CV and other documents of the employee to be saved on the platform.
16. employee status field hired or resigned and once resign is clicked an employee wiil have a resignation data-table
17. IF an employee is sacked or resigned they are unable to access their account
18. Implement better error handling for the admin panel UI
19. After creating a form the field should be cleared
20. Dummy data for admin, employees, clients,pet, and pet activities schedules
21. Implement Pet activity schedules relation manager for employee resource and PetResource
22. Implementing Notification and mailing system between client and employees
23. Implementing laravek database import, export and excel conversion with laravel excel
24. Dashboard for Clients to track client activities
25. Admin dashboard updates and revampining
26. deploy the project
27. male stud service sector
28. anything involving primary id (User, pet, etc) should use UUID as primary identifier

## CODE SNIPPETS

1. Get parents record from a filament relationship

```php
 public function form(Form $form): Form
    {
        dd($this->getOwnerRecord());
    }
```

2. Populate fields from the database and add them into filament fileds

```php
default(
    function (?User $record, Get $get, Set $set) {
        if (!empty($record) && empty($get('client_id'))) {
            $set('client_id', $record->client_id);
        }
        return "DPW/client/" . generateId();
        
})
// this function might have a similar feel
// disabled(fn ($record) => $record !== null)
```

3. Get more eloquent fields from and add to a filament form

   ```php
    Select::make('pet_id')
    ->relationship(name: 'pet', titleAttribute: "name")
    ->getOptionLabelFromRecordUsing(function (Pet $record) {
        return "{$record->name} ({$record->breed} | {$record->user->client_id})";
    })
   ```

## Note
