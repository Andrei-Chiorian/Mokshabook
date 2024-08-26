# Laravel Social Network - Instagram Clone

This project is a social network built with **PHP** and **Laravel**, designed to replicate the core features of Instagram. It allows users to register, share photos, follow other users, like posts, and comment on them, all within a dynamic and responsive interface styled with **Tailwind CSS**.

## Features

- **User Registration & Authentication:** Secure user registration, login, and password recovery using Laravel's authentication system.
- **Photo Sharing:** Users can upload and share photos with captions, mimicking Instagram's core functionality.
- **Follow System:** Follow and unfollow users to curate your personal feed.
- **Likes & Comments:** Interact with posts by liking and commenting, with real-time updates.
- **Real-Time Notifications:** Receive instant notifications when someone likes or comments on your posts or when you gain new followers.
- **Responsive Design:** The interface is fully responsive, thanks to **Tailwind CSS**, ensuring a seamless experience on mobile devices, tablets, and desktops.

## Technologies Used

- **PHP & Laravel:** Backend development and application structure.
- **MySQL:** Database management for storing user data, posts, comments, and likes.
- **Tailwind CSS:** For crafting a modern, responsive, and clean user interface.
- **JavaScript & AJAX:** To enhance user experience with real-time updates.
- **Pusher (Optional):** For implementing real-time notifications.

## Installation

To get started with the project, follow these steps:

1. **Clone the repository:**
   
       git clone https://github.com/Andrei-Chiorian/Mokshabook.git

2. **Navigate to the project directory:**
   
       cd Mokshabook

3. **Install dependencies:**
   
       composer install
       npm install

4. **Set up the environment:**
   
   Duplicate .env.example and rename it to .env.
   Configure your database and other environment variables in the .env file.
  
5. **Generate an application key:**
  
       php artisan key:generate
   
6. **Run database migrations:**
    
       php artisan migrate
   
7. **Start the development server:**
    
        php artisan serve
        npm run dev

8. **Open your browser and visit:**
 
        http://localhost:8000

## Customization
You can customize various aspects of the project:

- **UI Styling:** Modify the Tailwind CSS configurations in tailwind.config.js and styles in the resources/css directory.
- **Database Structure:** Adjust the migrations or models in the database/migrations and app/Models directories.
- **Routes and Controllers:** Customize the logic in routes/web.php and the corresponding controllers in app/Http/Controllers.
    
## Contributions
Contributions are welcome! If you have suggestions or improvements, feel free to fork the repository and submit a pull request. Feedback and enhancements are highly appreciated.

## License
This project is licensed under the MIT License.

## Contact
- **Name:** Andrei Chiorian
- **Email:** contacto@andreiwebdevelopment.es
- **LinkedIn:** https://www.linkedin.com/in/andrei-chiorian-web-development
- **GitHub:** https://github.com/Andrei-Chiorian
