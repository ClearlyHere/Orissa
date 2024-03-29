<?php

    namespace App\Code\Controller;

    use App\Code\Config\ExceptionHandler;
    use App\Code\Lib\FlashMessages;
    use App\Code\Lib\PasswordManager;
    use App\Code\Lib\UserSession;
    use App\Code\Model\DataObject\User;
    use App\Code\Model\Repository\UserRepository;
    use Couchbase\ValueRecorder;
    use DateTime;
    use Exception;

    class ControllerLogin extends AbstractController
    {
        /**Login Controller's definition of routes Map
         * @var array|string[]
         */
        protected static array $routesMap = [
            'Login' => 'view',
            'Login/logging' => 'logging',
            'Login/CreateAccount' => 'displayCreateAccount',
            'Login/create' => 'creatingAccount',
        ];

        /**Login Controller's definition of Login body's folder directory
         * @return string
         */
        protected static string $bodyFolder = '/Login';

        /**
         * Displays the login page if the user is not connected or redirect if not
         * @return void
         */
        public function view() : void
        {
            self::CheckNonUserAccess();
            $string = $this->getBodyFolder();
            $title = explode('/', $string)[1];
            $phpFile = '/' . strtolower($title) . '.php';
            //FIXME MAKE A CSS FILE BY DEFAULT FOR VIEWS?
            $this->displayView($title, $phpFile,  ['login/style.css']);
        }


        /**
         * Logs the user in if the information are correct or redirect if not
         * A notification is displayed to the user if the login failed
         * @return void
         */
        protected function logging() : void
        {
            try {
                self::CheckNonUserAccess();
                $user = (new UserRepository())->SelectWithLogin($_GET['username']);
                $inputPassword = $_GET['password'];

                ExceptionHandler::checkIsTrue($user instanceof User, 103);
                $checkPassword = PasswordManager::verify($inputPassword, $user->getHashedPassword());
                ExceptionHandler::checkIsTrue($checkPassword, 103);

                FlashMessages::add("success", "Bonjour " . $user->getUsername() . "!");
                UserSession::connect($user->getUsername());
                header("Location: /Orissa/Home");
                exit();
            } catch (Exception $e) {
                FlashMessages::add("danger", "Vérifiez que vos informations sont corrects!");
                // Redirect user if login failed
                header("Location: /Orissa/Login");
                exit();
            }
        }

        /**
         * Displays the create account page if the user is not connected or redirect if not
         * @return void
         */
        protected function displayCreateAccount() : void
        {
            self::CheckNonUserAccess();
            $this->displayView("Create an account", "/CreateAccount.php", ['login/style.css']);
        }

        /**
         * Creates an account if the information are valid or redirect if not
         * A notification is displayed to the user if the creation failed
         * @return void
         */
        protected function creatingAccount() : void
        {
            self::CheckNonUserAccess();
            try {
                $birthDate = new DateTime($_GET['birthdate']);
                $_GET['birthdate'] = date_format($birthDate, 'Y-m-d');
                $createdUser = UserRepository::BuildWithForm($_GET);
                $result = (new UserRepository())->Insert($createdUser);
                ExceptionHandler::checkIsTrue(!is_string($result), 104);

                FlashMessages::add("success", "Bienvenu à Orissa, " . $createdUser->getUsername() . "!");
                UserSession::connect($createdUser->getUsername());
                header("Location: /Orissa/Home");
                exit();
            } catch (Exception $e){
                $errorMessage = ExceptionHandler::getErrorMessage($e->getCode());
                FlashMessages::add("danger", $errorMessage);
                header("Location: CreateAccount");
                exit();
            }
        }
    }