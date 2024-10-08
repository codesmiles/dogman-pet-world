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
12. Implement factories and seeders for client, employee and admin users.✅
13. Dummy data for admin, employees, clients,pet, and pet activities schedules ✅
14. After creating a form the field should be cleared and redirected to the main list ✅
15. anything involving primary id (User, pet, etc) should use UUID as primary identifier ✅
16. Remove the name Tobi Adebisi from my repo(cleared the git global config name and email)✅
17. Implement Pet activity schedules relation manager for employee resource and PetResource ✅
18. Test Employee status feature and the new IsEmployee middleware with the status active and not✅
19. saving images, profile pictures and cv documents of users and employees should be implemented✅
20. the "client_id",in the user model not being input into the filament form so i will work debugging the update fields. ✅
21. create relationship manager between petResource and PetActivitySchedule then with employee and pet activity schedule to view all activity under an employee ✅
    1. display avatar for images✅
    2. image upload with filament✅
    3. file upload with filament(CV)✅
    4. remove cloudinary/cloudinary_php✅
    5. implement file upload with cloudinary✅
    6. employee CV and other documents of the employee to be saved on cloudinary.✅
    7. make sure view resume upload works
22. IF an employee is sacked or resigned they are unable to access their account✅
    1. attack the schema widleware to monitor sacked or deactivated
    2. employee status field hired or resigned and once resign is clicked an employee wiil have a resignation data-table
23. Implement better error handling for the admin panel UI
24. Upload many certifications and documentation for employees
25. Implementing Notification and mailing system between client and employees
26. Implementing laravel database import, export and excel conversion with laravel excel
27. Dashboard for Clients to track client activities
28. Admin dashboard updates and revampining
29. deploy the project
30. male stud service sector
31. mailing and notifications for admin
32. apointment booking system
33. Inventory management system
34. Employee view profile page and edit some features
35. make sure pet profile profile picture is working
36. implement forget and reset password for admin and employees
37. make user be in charge of updating their password by themselves
    1. forget and reset password
    2. update password upon registration
    3. admin ability to authenticate self or login as a particular user
    4. admin send mail button to user so password should be updated by the user
38. make edit customer input field not required for some fields when trying to edit users

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
