
The propose of this project it's to have a professional blog, where I'll document concepts that I've learned and also have a self-presentation as a developer, so people could know me at the same time they know what I'm doing 'whoitisandwhathisdoing' shit.

### Tech Stack
These project will helpme to lean some important concepts, so I'll put some overengineering stuff on the table. Here's the list of concepts and technologies required for this project.

#### Backend
Plataform: .NET
Database: SQLSERVIER / Azure SQL
Conpects:
- Containerization
- DDD
- Messaging with RabitMQ
- Microservices (send email service)
- Cloud plataform
- Email verification and rate limit for IP

Frontend
Plataform: Angular
Features:
- Static home page with my presentation
- Blog posts list with background image, date, title, description and tags sort by date
- Blog post with background image, author, title and date. All on markdown style
- Other post sugestions based on tags or date
- Send email button at every post
- Pop up for user email info


### Requirements
This is a 11 days project, started at 11/07/2025 to be delivered at 21/07/2025. It's a simple project made to apply all those concepts.
Here's the list of concepts and technologies that are our priority in this deadline:
- Messaging with microservices
- Cloud with Azure

### Scalability
After deadline, we want to keep improving the software, appying features like:
- Caching
- Tests
- Observability


### Fluxogram

#### POST
- Author (me) send request with unique token
- Application BE validate the **token**
- If **token** is valid, Application BE validate the **request**
- If **request** is valid, Application BE insert into database

#### LIST
- Application BE/FE list posts sort by date and paginated
- If user interact, Application FE show the complete post

#### EMAIL
- Application FE provide a field for user to inform his email
- Application BE limit requests for ip
- Application BE receive request with post information and email
- Application BE verify the e-mail
- If email is valid BE Service communicate with email service to send it

That's the fluxogram for the MVP, all features should be delivered until first project deadline (21/07/2025)