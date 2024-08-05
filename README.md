# Dogman Pet World

## Commands

- Create a new Filament custom admin user user custom -> ```sail artisan create:admin-user```
- command for configuring shell alias from ```./vendor/bin/sail``` to ```sail up``` -> ```alias sail='sh $([ -f sail ] && echo sail || echo vendor/bin/sail)'```
- command for relating  UserResource to Employee -> ```php artisan make:filament-relation-manager ClientResource Employee user_id```
- Accessing mysql shell command -> ```sh mysql -u root -p```

## TO DO List

1. Admin and employee access roles ✅
2. Work on how disabled fields work ✅
3. proper text editor for textareas ✅
4. Admin can only register employees ✅
5. employees can only regeister clients ✅
6. Some Pet fields in the tables are blank ✅
7. formating the relation manager to do it work. ✅
8. Client can sign in with client id and password. ✅
9. Properly format the form fields and table fields ✅
10. Enums for static data like default password and all ✅
11. work on the autorizations form admin and regular models ✅
12. Dummy data for admin, employees, clients,pet, and pet activities schedules ✅
13. After creating a form the field should be cleared and redirected to the main list ✅
14. anything involving primary id (User, pet, etc) should use UUID as primary identifier ✅
15. Implement Pet activity schedules relation manager for employee resource and PetResource ✅
16. the "client_id",in the user model not being input into the filament form so i will work debugging the update fields. ✅
17. create relationship manager between petResource and PetActivitySchedule then with employee and pet activity schedule to view all activity under an employee ✅
18. saving images, profile pictures and cv documents of users and employees should be implemented
    1. image upload with filament
    2. file upload with filament(CV)
    3. avatar display for images
    4. implement file upload with cloudinary
    5. employee CV and other documents of the employee to be saved on the platform.
19. employee status field hired or resigned and once resign is clicked an employee wiil have a resignation data-table
20. IF an employee is sacked or resigned they are unable to access their account
    1. deactivate or resign schema role through status in employee tableth a mid
    2. attack the schema widleware to monitor sacked or deactivated
21. Implement better error handling for the admin panel UI
22. Implementing Notification and mailing system between client and employees
23. Implementing laravel database import, export and excel conversion with laravel excel
24. Dashboard for Clients to track client activities
25. Admin dashboard updates and revampining
26. deploy the project
27. male stud service sector
28. mailin and notifications for admin
29. apointment booking system

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

4. Adding uuid to fields id

    ```php
        $new_user = new User();
        $new_user->id = Str::uuid();
    ```

5. set a field to ReadOnly

    ```php
        Forms\Components\TextInput::make('file_number')->readOnly()
    ```

6. filament handle record creation used to debug incase there's error in saving data.

    ```php
           protected function handleRecordCreation(array $data): Model
    {
        $data["employee_id"] = "DPW/employee/";
        return static::getModel()::create($data);
    }
    ```

## Note
