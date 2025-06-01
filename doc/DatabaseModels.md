# Database Schemas & Models Reference

This document provides an overview of all Eloquent models and their corresponding database tables (schemas) available in this project, organized by namespace.

---

## Processton\\Contact\\Models
- **Contact**
  - Table: `contacts`
  - Fields: id, prefix, first_name, last_name, email, phone, linkedin_profile, twitter_handle, notes, created_at, updated_at
  - Relationships: hasMany CustomerContact

## Processton\\Lead\\Models
- **Lead**
  - Table: `leads`
  - Fields: id, title, description, status, source, priority, submission (json), created_at, updated_at

## Processton\\Items\\Models
- **Item**
  - Table: `items`
  - Fields: id, entity_type, entity_id, sku, price, currency_id, created_at, updated_at
  - Relationships: morphTo entity
- **Product**
  - Table: `products`
  - Fields: id, name, created_at, updated_at
- **Service**
  - Table: `services`
  - Fields: id, name, created_at, updated_at
  - Relationships: morphTo Item
- **SubscriptionPlan**
  - Table: `subscription_plans`
  - Fields: id, name, created_at, updated_at
- **Asset**
  - Table: `assets`
  - Fields: id, name, created_at, updated_at

## Processton\\Customer\\Models
- **Customer**
  - Table: `customers`
  - Fields: id, identifier, is_personal, enable_portal, currency_id, creator_id, company_id, contact_id, user_id, created_at, updated_at
  - Relationships: (see code for details)
- **CustomerContact**
  - Table: `customer_contacts`
  - Fields: id, customer_id, contact_id, job_title, department, created_at, updated_at

## Processton\\AccessControll\\Models
- **Role**
  - Table: `roles`
  - Fields: id, name, guard_name, created_at, updated_at
  - Relationships: belongsToMany Permission, belongsToMany User, hasMany AssignedPersmission
- **Permission**
  - Table: `permissions`
  - Fields: id, group, sub_group, name, description, created_at, updated_at
- **Ability**
  - Table: `abilities`
  - Fields: id, name, model, created_at, updated_at
- **AssignedAbility**
  - Table: `assigned_abilities`
  - Fields: id, user_id, ability_id, allowed, created_at, updated_at
- **AssignedPersmission**
  - Table: `assigned_persmissions`
  - Fields: id, role_id, permission_id, created_at, updated_at
- **PermissionAbility**
  - Table: `permission_abilities`
  - Fields: id, permission_id, ability_id, created_at, updated_at
- **UserRole**
  - Table: `user_roles`
  - Fields: id, user_id, role_id, created_at, updated_at

## Processton\\Form\\Models
- **Form**
  - Table: `forms`
  - Fields: id, name, slug, schema (json), is_published, campaign_id, created_at, updated_at
  - Relationships: belongsTo Campaign

## Processton\\Locale\\Models
- **Country**
  - Table: `countries`
  - Fields: id, color, region_id, name, iso_2_code, iso_3_code, dial_code, deleted_at, created_at, updated_at
  - Relationships: hasMany City, belongsTo Region
- **City**
  - Table: `cities`
  - Fields: id, country_id, name, deleted_at, created_at, updated_at
- **Region**
  - Table: `regions`
  - Fields: id, color, name, code, parent_id, deleted_at, created_at, updated_at
- **Zone**
  - Table: `zones`
  - Fields: id, color, city_id, name, code, parent_id, deleted_at, created_at, updated_at
- **Currency**
  - Table: `currencies`
  - Fields: id, color, name, code, symbol, precision, thousand_separator, decimal_separator, swap_currency_symbol, created_at, updated_at
- **CurrencyConversion**
  - Table: `currency_conversions`
  - Fields: id, from_currency_id, to_currency_id, conversion_rate, created_at, updated_at
- **Address**
  - Table: `addresses`
  - Fields: id, entity_type, entity_id, street, city, state, country_id, postal_code, address_line_2, neighborhood, timezone, latitude, longitude, place_id, formatted_address, google_response, created_at, updated_at
  - Relationships: belongsTo Country, morphTo entity
  - Accessors: full_address, entity_name, related_entity, related_entity_name

## Processton\\Org\\Models
- **Org**
  - Table: `orgs`
  - Fields: id, group, type, title, description, org_key, org_value, org_options, created_at, updated_at

---

For detailed field definitions, see the migration files in each module's `database/migrations` directory.
