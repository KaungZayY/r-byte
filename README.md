# R Byte

R-byte, an open source project management tool!.

## Table of Contents
1. [Features](#features)
2. [Usage](#usage)
3. [Tech Stack](#tech-stack)
4. [Database Structure](#database-structure)
5. [Contributing](#contributing)
6. [Conclusion](#conclusion)
7. [License](#license)


## Features
- **Task Management**: Create, update, and track tasks with deadlines.
- **Sprints**: Group tasks into sprints for agile project management.
- **User Roles & Permissions**: Assign tasks to teammates, control who can create, update, or delete tasks.
- **Dark/Light Mode**: Auto-detect user's system theme or toggle manually.
- **Real-Time Collaboration**: Powered by Laravel Livewire for real-time updates without page reloads.
- **Error Log**: Keep track of bugs and errors.
- 
## Usage
After installation and setup:
1. **Register/Login**: You can register as a new user or login using the existing credentials.
2. **Create a Project**: Start by creating a new project. Add a name and description.
3. **Manage Tasks**: Within a project, create tasks with deadlines and assign them to team members.
4. **Sprints**: Group tasks into sprints to follow agile methodology.
5. **Role Management**: Assign team members different roles (admin, user, viewer) to control their access and permissions.
6. **Theme Management**: Toggle between light and dark themes manually, or let it auto-detect based on system preferences.

##  Tech Stack

- **Frontend**: Tailwindcss, Alpine.Js, Livewire
- **Backend**: Laravel 10
- **UI**: Jetstream

## Database Structure
- [Entity Relationship Diagram](https://lucid.app/lucidchart/5288231c-4337-41ea-bfaa-e145e9d2b27b/edit?invitationId=inv_ca02fa1a-ffe1-4e04-9234-290f79935775&page=HWEp-vi-RSFO#)

## Contributing

### Prerequisites

- PHP >= 8.1
- Composer
- Node.js (with npm)
- MySQL or any other database supported by Laravel
- Docker (optional)


### Friendly Instructions :)

Contributions are welcome! If you would like to contribute to R Byte, please follow these steps:

#### 1. Fork the Git Repository

#### 2. Create a new branch: 
```bash
git checkout -b main.
```

#### 3. Commit your changes: 
```bash
git commit -m 'Some features'
```

#### 4. Push to the branch: 
```bash
git push origin main.
```

#### 5. Submit a pull request.

## Conclusion

R Byte is a simple, open-source project management tool aimed at helping teams manage tasks, sprints, and collaboration more easily. Built with Laravel, Livewire, and TailwindCSS, it provides a clean, responsive interface with real-time updates and theme support. While it's still growing, R Byte is designed to make project management straightforward and accessible. Contributions to improve and expand the tool are always welcome!

## License
R Byte is open-source software licensed under the MIT License.