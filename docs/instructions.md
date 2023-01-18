[Back to Main Page](/laravel-zoho-oauth/)

## Creating Zoho OAuth Credentials

Follow these instruction to create `Client ID`,`Client Secret` and `Zoho Authorization Code`

1. **Step 1 of 8** [Log in to Zoho Developer Console](https://accounts.zoho.com/developerconsole)
![image](/images/Step-01.png)

2. **Step 2 of 8** Create a client type
![image](/images/Step-02.png)

3. **Step 3 of 8** Create a new **Self Client**
![image](/images/Step-03.png)

4. **Step 4 of 8** Confirm
![image](/images/Step-04.png)

5. **Step 5 of 8** Copy the client ID and client secret to your laravel `.env`
![image](/images/Step-05.png)


6. **Step 6 of 8** Add 
    - [ ] **Scope separated by a comma**
         <details>
              <summary>Zoho Inventory Scope</summary>
              
        | Scope           | Value                           | Description  |
        | --------------- | ------------------------------- |------------
        | Contacts        | ZohoInventory.contacts.CREATE   |  |
        |                 | ZohoInventory.contacts.UPDATE   |  | 
        |                 | ZohoInventory.contacts.READ     |  |
        |                 | ZohoInventory.contacts.DELETE   |  |
        | Items           | ZohoInventory.items.CREATE   |  |
        |                 | ZohoInventory.items.UPDATE   |  | 
        |                 | ZohoInventory.items.READ     |  |
        |                 | ZohoInventory.items.DELETE   |  |
               
        </details>

    - [ ] **Duration:** The generated code will expire after the duration which you select. Once expired, you have to generate a new one.
    - [ ] **Description:** Describe your scope


![image](/images/Step-06.png)

7. **Step 7 of 8** Select additional permissions (where applicable)
![image](/images/Step-07.png)

8. **Step 8 of 8** Copy the code
![image](/images/Step-08.png)


9. By the end of process your `.env` should have variable like this
```dotenv
# Zoho OAuth Credentials
BASE_OAUTH_URL=https://accounts.zoho.in/
ZOHO_CLIENT_ID=1000.YJ2B09AQN2QCEIBX07FMU3ESFK65RJ
ZOHO_CLIENT_SECRET=b68f268a48deb7eb1db18ed480ce5465ab2503a9fd
ZOHO_CODE=1000.51b608672206a6086ae428d269e.4ed76b01ccf3555444c047e81c860248849a37aaf
ZOHO_SCOPE=ZohoInventory.items.READ,ZohoCRM.modules.leads.ALL,ZohoCRM.modules.contacts.DELETE
```

[Back to Main Page](/)

