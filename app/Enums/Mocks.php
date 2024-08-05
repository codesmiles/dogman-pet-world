<?php
namespace App\Enums;

enum Mocks: string
{
    case DEFAULT_PASSWORD = 'DefaultPassword123!';

    case ADMIN_NAME = "admin";
    case ADMIN_EMAIL = "admin@example.com";
    case ADMIN_ADDRESS = "Egbeda, Lagos";
    case ADMIN_PHONE_NUMBER = "08123456789";
    case ADMIN_CLIENT_ID = "DPW/client/admin";
    case ADMIN_EMPLOYEE_ID = "DPW/employee/admin";



    case CLIENT_NAME = "client";
    case CLIENT_EMAIL = "client@example.com";
    case CLIENT_ADDRESS = "ikotun Lagos";
    case CLIENT_PHONE_NUMBER = "081987654321";
    case CLIENT_ID = "DPW/client/client";

    case PET_NAME = "Test Pet";
    case PET_BREED = "breed";
    case PET_PHOTO = "test-photo.jpg";
    case PET_GENUS = "canine";
    case PET_GENDER = "Male";
    case PET_STATUS = "Alive";
    case PET_FILE_NUMBER = "Test File Number";
    case PET_MICROCHIP_NUMBER = "123456789";
    case PET_RETAINERSHIP_PLAN = "bronze";
    case CUSTOM_PLAN_DETAILS = "Daile checkup";


    case PET_ACTIVITY_REPORT = "Temperature";
    case PET_ACTVITY_TREATMENT_OR_VACCINATIONS = "antirabies vaccinations";

    case EMPLOYEE_STATUS = "active";
}


enum IntMock:int
{
    case PET_WEIGHT = 10;
}


