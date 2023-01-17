<p align="center"><img src="./src/icon.svg" width="100" height="100" alt="Postfinance for Craft Commerce icon"></p>

<h1 align="center">commerce-postfinance</h1>

This plugin provides a [Postfinance-Checkout](https://checkout.postfinance.ch/user/login) integration for [Craft Commerce](https://craftcms.com/commerce) supporting Transactions and Refunds.

## Requirements

* Craft CMS 4.0 or later
* Craft Commerce 4.0 or later
* postfinancecheckout sdk 3.0.1 or later

## Installation

You can install this plugin using Composer.

#### With Composer

Open composer.json file of project directory and Add the below lines (only for this repository).

```bash
{
    "name": "klarplan-ss4u/commerce-postfinance",
    "require": {
        "klarplan/commerce-postfinance": "*"
    },
    "repositories": [
        {
            "type": "vcs",
            "url":  "https://github.com/klarplan-ss4u/commerce-postfinance"
        }
    ]
}
```


Open your terminal and run the following commands:

```bash
# go to the project directory
cd /path/to/my-project.test

# tell Composer to load the plugin
composer require klarplan/commerce-postfinance

# tell Craft to install the plugin
php craft install/plugin commerce-postfinance
```
## Setup


To add the Postfinance payment gateway in the Craft control panel, navigate to **Commerce** → **System Settings** →  **Gateways**, create a new gateway, set the gateway type to “PostFinance Checkout” and enter the PostFinance Checkout Space ID, PostFinance Checkout User ID and Authentication Key that you can create in the [setup assistant](https://checkout.postfinance.ch/space/select?target=/space/assistant).
Alternatively, you can manually create an [application user](https://checkout.postfinance.ch/en-us/doc/permission-concept#_create_application_users)
and [Assign Roles to User](https://checkout.postfinance.ch/en-us/doc/permission-concept#_assign_roles_to_users).


### Payment methods configuration

#### Make sure you have  payment method configuration name  as follow
- Credit / Debit Card
- PostFinance Card
- PostFinance E-Finance
- Invoice
- TWINT

To check your payment method configuration in your postfinace account, navigate to   **Space** → **Configuration** →  **Payment Methods**

## Webhooks

You’ll need to create webhooks in postfinance account to utilize webhooks.

### Configuring postfinance checkout

Create [webhook](https://checkout.postfinance.ch/en-us/doc/webhooks) in your Postfinance account. The webhook URL can be found in your Commerce Stripe gateway settings.

The required entity states are:

#### For Transaction

- `Fullfill`
- `Failed`
- `Voided`
- `Decline`

#### For Refund

- `Failed`
- `Successfull`
