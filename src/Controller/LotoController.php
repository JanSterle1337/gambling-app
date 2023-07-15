<?php

namespace App\Controller;

use App\Entity\Combination;
use App\Entity\PlayingGame;
use App\Repository\GameRepository;
use App\Repository\PlayingGameRepository;
use App\Service\BoundaryChecker;
use App\Service\CheckCombinationFormat;
use App\Service\CombinationGenerator;
use App\Service\DuplicateNumberChecker;
use App\Service\MatchNumbersToCombination;
use App\Utils\Sanitizer;
use App\Utils\StringToArrayConverter;
use League\Plates\Engine as TemplateEngine;
use Symfony\Component\HttpFoundation\RedirectResponse;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;


class LotoController
{
    public TemplateEngine $templates;
    public Sanitizer $sanitizer;
    public BoundaryChecker $boundaryChecker;
    public CheckCombinationFormat $checkCombinationFormat;
    public DuplicateNumberChecker $duplicateNumberChecker;
    public GameRepository $gameRepository;
    public StringToArrayConverter $stringToArrayConverter;
    public PlayingGameRepository $playingGameRepository;

    public function __construct
    (
        TemplateEngine $templates,
        Sanitizer $sanitizer,
        BoundaryChecker $boundaryChecker,
        CheckCombinationFormat $checkCombinationFormat,
        DuplicateNumberChecker $duplicateNumberChecker,
        GameRepository $gameRepository,
        StringToArrayConverter $stringToArrayConverter,
        PlayingGameRepository $playingGameRepository
    )
    {
        $this->templates = $templates;
        $this->sanitizer = $sanitizer;
        $this->boundaryChecker = $boundaryChecker;
        $this->checkCombinationFormat = $checkCombinationFormat;
        $this->duplicateNumberChecker = $duplicateNumberChecker;
        $this->gameRepository = $gameRepository;
        $this->stringToArrayConverter = $stringToArrayConverter;
        $this->playingGameRepository = $playingGameRepository;
    }

    public function showAction(Request $request): Response
    {
        return new Response(
            $this->templates->render(
                'loto',
                [
                    'errors' => "",
                    'playedCombination' => null,
                    'generatedCombination' => null,
                    'matchedCombination' => null,
                    'success' => false
                ]
            )
        );
    }

    /**
     * @throws \Exception
     */
    public function playAction(Request $request): Response
    {

        $userData = $request->request->all(); // wanted to retrieve {id} from /games/1 but doesnt work lol
        $gameRules = $this->gameRepository->getGameRules(1); //retrieve game rules from database and instantiate Game object
        $userData = $this->sanitizer->sanitizeStringData(['loto-combination'], $userData);  //sanitize input data

        if (!$this->checkCombinationFormat->checkComboFormat($userData['loto-combination'], $gameRules->getHowManyNumbers())) {
            echo "ERROR";
            return new Response(
                $this->templates->render('error/404'),
                Response::HTTP_NOT_FOUND
            );
        }

        $userData = $this->stringToArrayConverter->convert(", ", " ", "loto-combination", $userData); //convert string to array format

        $playedCombination = new Combination($userData,$gameRules);

        $comboGenerator = new CombinationGenerator($gameRules); //create a combination generator obj with current game rules
        $generatedCombination = $comboGenerator->generateCombination(); //generate Combination object with rand func

        $matcher = new MatchNumbersToCombination($playedCombination, $generatedCombination);
        $matchedCombination = $matcher->createIntersectedCombination(); //generate Combination object with an array of intersected values

        $playedGame = new PlayingGame($playedCombination, $generatedCombination, $matchedCombination, $gameRules);
        $this->playingGameRepository->saveGameData($playedGame);        //save data in database

        return new Response(
            $this->templates->render(
                "loto",
                [
                    'errors' => "",
                    'playedCombination' => $playedCombination,
                    'generatedCombination' => $generatedCombination,
                    'matchedCombination' => $matchedCombination,
                    'success' => true
                ]
            ),

        );

    }
}