# Dogman Pet World

## Commands

- ```create:admin-user``` -> Create a new Filament custom admin user user custom
- ```alias sail='sh $([ -f sail ] && echo sail || echo vendor/bin/sail)'``` -> command for configuring shell alias from ```./vendor/bin/sail``` to ```sail up```
- ```php artisan make:filament-relation-manager ClientResource Employee user_id``` -> command for relating  UserResource to Employee

## TO DO List

1. Work on how disabled fields work
2. work on the autorizations form admin and regular models
3. Properly format the form fields and table fields
4. the  "client_id",in the user model not being input into the filament form so i will work debugging the update fields.
5. formating the relation manager to do it work.
6. employee CV being saved on the platform.
7. Client can sign in with client id and password.
8. employees can only regeister clients
9. Admin can only register employees
10. employee status field hired or resigned and once resign is clicked an employee wiil have a resignation data-table
11. IF an employee is sacked or resigned they are unable to access their account
12. proper text editor for text areas
13. Admin and employee access roles
14. create relationship manager between petResource and pet_activity_schedule then with employee and pet activity schedule to view all activity under an employee

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
