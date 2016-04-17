1.System Introduction
1.1 Infrastructure
The Peer To Peer Freight system is developed with Laravel, Bootstrap.
1.2 Function
The system includes three roles: 
1)Poster. Poster is like a customer, he can see all the driver routes published by the drivers. He can also place an order, or cancel an order that hasn't been delievered yet.
2)Driver. Driver is like a service provider.He can offer peer to peer delievering services. Drivers can publish their routes and prices to the system, thus the posters can see and place order for the drivers. Drivers can edit their routes and responde to the orders, like accepting an order, reject an order or finish an order.
3)Admin. The Admin users can edit infomation about routes and other user infomations.
There is an admin user builtin. All other users can be registered through the register page. Posters and Drivers need to login to use full functionality.
2.Database explanation
Users: id, name, email, password, type(posible values:0, 1, 2. 0 means admin, 1 means driver, 2 means poster)
Routes: id, start, end. A route includes a start and an end, nothing more. Many drivers may run same route, so we have driverroutes table to store driver specific route information.
Driverroutes:id, driverid(foreign key reference to id in users table), routeid(foreign key references to id in routes table), price(the price of the driver), capacity(capacity of the car), offered(if offered to pick up).
Trips:(trips table stores orders of all drivers). id, userid(foreign key references to users table, means to which poster this order belongs), driverrouteid(foreign key references to driverroutes table), posterprice(how much the poster wants to pay), status(posible value 0, 1, 2. 0 means order placed, 1 means order accepted and started, 2 means order finished or ended).

3.User interface flow diagrams
see file

4.Installation and configuration
4.1 install xampp and start mysql and apache. 
