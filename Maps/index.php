<html>
<head>
    <meta charset="UTF-8">
    <title>Photo Friends</title>
    <link rel="stylesheet" href="assets/css/bootstrap.min.css">
</head>
<body>
    /*<div class="main" ng-app="myList" ng-controller="myListController">
        <h1>Item's List</h1>
        <div class="addItem">
            <input ng-model = "newItem" placeholder="Add Item" class="addText">
            <button ng-click="pushItem()">Add</button>
        </div>
        <ul>
            <li ng-repeat="i in items">
                {{i}}
                <span ng-click="deleteItem($index)">x</span>
            </li>


        </ul>
    </div>*/

    <div class="container">
        <div style="width: 500px; margin: 50px auto;">
            <from method="post" action="<?php echo htmlspecialchars($_SERVER['PHP_SELF']); ?>" autocomplete="off">
                <center><h2>Login</h2></center>
                <hr/>
                <div class="form-group">
                    <label for="email" class="control-label">Email</label>
                    <input type="email" name="email" class="form-control">
                </div>
                <div class="form-group">
                    <label for="password" class="control-label">Password</label>
                    <input type="password" name="email" class="form-control">
                </div>
            </from>
        </div>
    </div>

    <script src="https://ajax.googleapis.com/ajax/libs/angularjs/1.5.6/angular.min.js"></script>
    <script src="script.js"></script>
</body>
</html>