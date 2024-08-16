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
16. Test Employee status feature and the new IsEmployee middleware with the status active and not✅
17. saving images, profile pictures and cv documents of users and employees should be implemented✅
18. the "client_id",in the user model not being input into the filament form so i will work debugging the update fields. ✅
19. create relationship manager between petResource and PetActivitySchedule then with employee and pet activity schedule to view all activity under an employee ✅
    1. image upload with filament✅
    2. file upload with filament(CV)✅
    3. remove cloudinary/cloudinary_php✅
    4. implement file upload with cloudinary✅
    5. employee CV and other documents of the employee to be saved on cloudinary.✅
    6. display avatar for images
    7. make sure view resume upload works
20. IF an employee is sacked or resigned they are unable to access their account
    1. attack the schema widleware to monitor sacked or deactivated
    2. employee status field hired or resigned and once resign is clicked an employee wiil have a resignation data-table
21. Implement better error handling for the admin panel UI
22. Upload many certifications and documentation for employees
23. Implementing Notification and mailing system between client and employees
24. Implementing laravel database import, export and excel conversion with laravel excel
25. Dashboard for Clients to track client activities
26. Admin dashboard updates and revampining
27. deploy the project
28. male stud service sector
29. mailing and notifications for admin
30. apointment booking system
31. Inventory management system
32. Employee view profile page and edit some features
33. make sure pet profile profile picture is working
34. Remove Tobi Adebisi from my repo

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

7. Get the url of a cludinary picture ->  
8. ```php 
   Get$cloudinaryUrl = cloudinary()->getUrl($filePath)
   ``` 

   or using the method in the table
   
   ```php
      ImageColumn::make('profile_picture')
                ->url(fn ($record) => cloudinary()->getUrl($record->profile_picture))
   ```

## Note
