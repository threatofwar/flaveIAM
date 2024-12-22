# flaveIAM

This project runs Laravel application, MySQL database, Nginx server, and a Flask-based Terraform integration to provision AWS IAM users.

## Requirements

### **Docker**
   - [Install Docker](https://docs.docker.com/engine/install/)
   - [Install Docker Compose](https://docs.docker.com/compose/install/)

## Setup

### 1. **Clone the repo**
   ```bash
   git clone https://github.com/threatofwar/flaveIAM.git
   cd flaveIAM/
   ```

### 2. **Copy the `.env.example` to create `.env`**
    ```bash
    cp .env.example .env
    ```
- **Environment Variables:**
  - `AWS_ACCESS_KEY_ID` and `AWS_SECRET_ACCESS_KEY` - Sufficient AWS IAM user to have create user privilage.
    ```env
    AWS_ACCESS_KEY_ID=
    AWS_SECRET_ACCESS_KEY=
    ```
### 3. **Build and start the containers**
    ```bash
    docker compose up --build
    ```

### 4. **Accessing the application**
  - Open your browser and navigate to:
    ```bash
    http://localhost:8000
    ```

## Directory Structure
```plaintext
.
├── docker-compose.yml
├── laravel
├── mysql
├── nginx
└── terraflask
```
