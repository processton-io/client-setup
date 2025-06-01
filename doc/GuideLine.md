## Product Example Implimentation

The Product Model defines the structure and attributes of a product within the system. It typically includes fields such as product name, description, price. This model serves as the foundation for managing product-related data and enables consistent handling of product information across different features and modules.

In order to use this first extend products table with the fields you need. Then Extend you model lets say Cloth from Product model. 

This is one usecase you can create seprate tables for you products and overwrite product model createEntity to handle your custom use cases.

## Available functions