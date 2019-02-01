# PHP task - Events log

#### Specification
Design a component responsible for logging events and actions that may occur in some
application. Event logger should be capable of logging information about the type and name of
the event that has been taken, performer of the action, subject of the action, date/time when the
action was taken and optionally some other, meta information.
Event logger must support storing of log information into various storage types, for example
filesystem, database, etc. For the showcase purpose, create one concrete storage strategy of
your choice.

#### Tips
Sketch out all classes and interfaces that are involved. Focus on abstraction and modeling,
instead of concrete implementations. Purpose of this test is to examine your skills and way of
thinking, you don’t have to go deep in details. Use plain PHP, without frameworks.

#### Bonus
Product guys have received feedback from users that the app is a bit slow. It is decided “from
above” that app’s UI can’t suffer from any “user irrelevant” actions in the system, thus your code
will not be responsible for actually storing the logs in any persistence layer any more. It will be
done by another developer, in another department, through a microservice in charge of writing
logs. They choose where and how to store it. You just need to provide a “feed” of event logs.

Think through, pick your weapons of choice, and explain (don’t implement) what, why and how
would you use for this use case.

#### Additions:
Add templates for different ways of logging.

#### Sending solution
Upload your solution on [GitHub](https://github.com/) or [Bitbucket](https://bitbucket.org/) and provide us link to your repository. Good luck!
