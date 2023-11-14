<?php

    namespace App\Code\Controller;

    use App\Code\Config\ExceptionHandler;
    use App\Code\Lib\FlashMessages;
    use App\Code\Lib\PasswordManager;
    use App\Code\Lib\UserSession;
    use App\Code\Model\DataObject\User;
    use App\Code\Model\Repository\UserRepository;
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

        public function view() : void
        {
            $string = $this->getBodyFolder();
            $title = explode('/', $string)[1];
            $phpFile = '/' . strtolower($title) . '.php';
            //FIXME MAKE A CSS FILE BY DEFAULT FOR VIEWS?
            $this->displayView($title, $phpFile,  ['style.css']);
        }

        protected function logging() : void
        {
            try {
                $user = (new UserRepository())->selectWithUsername($_GET['username']);
                $inputPassword = $_GET['password'];

                ExceptionHandler::checkTrueValue($user instanceof User, 103);
                $checkPassword = PasswordManager::verify($inputPassword, $user->getHashedPassword());
                ExceptionHandler::checkTrueValue($checkPassword, 103);

                FlashMessages::add("success", "Bonjour " . $user->getUsername() . "!");
                UserSession::connect($user->getUsername());
                header("Location: /Orissa/Home");
                exit();
            } catch (Exception $e) {
                FlashMessages::add("danger", "Verifier que vos informations sont corrects!");
                $this->view();
            }
        }

        protected function displayCreateAccount() : void
        {
            $this->displayView("Create an account", "/CreateAccount.php", ['style.css']);
        }

        protected function creatingAccount() : void
        {
            try {
                $birthDate = new DateTime($_GET['birthdate']);
                $_GET['birthdate'] = date_format($birthDate, 'Y-m-d');
                $createdUser = UserRepository::constructWithForm($_GET);
                $result = UserRepository::save($createdUser);
                ExceptionHandler::checkTrueValue($result, 104);

                FlashMessages::add("success", "Bienvenu à Orissa, " . $createdUser->getUsername() . "!");
                UserSession::connect($createdUser->getUsername());
                header("Location: /Orissa/Home");
                exit();
            } catch (Exception $e){
                if ($e->getCode() == 104){
                    FlashMessages::add("danger", "Cet utilisateur existe déjà");
                    $this->error($e);
                }
            }
        }
    }