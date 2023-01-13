<?php

namespace App\Controller;

use App\DTO\SeriesCreateFormInput;
use App\Entity\Episode;
use App\Entity\Season;
use App\Entity\Series;
use App\Form\SeriesType;
use App\Repository\SeriesRepository;
use Doctrine\ORM\EntityManagerInterface;
use Doctrine\ORM\PersistentCollection;
use Psr\Cache\CacheItemInterface;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\Form\Extension\Core\Type\SubmitType;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\HttpFoundation\RedirectResponse;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class SeriesController extends AbstractController
{
    public function __construct(
        private SeriesRepository $seriesRepository,
        private EntityManagerInterface $entityManager
    ){
    }

    #[Route('/series', name: 'app_series', methods: ['GET'])]
    public function seriesList(Request $request): Response
    {
        $session = $request->getSession();
        //$successMessage = $session->get("success");
        $session->remove("success");
        /*
        $seriesList = [
            'Lost',
            'Grey\'s Anatomy',
            'Loki',
            'Suits'
        ];
        */

        /** @var Series[] $seriesList */
        $seriesList = $this->seriesRepository->findAll();

        $html = "<ul>";
        foreach ($seriesList as $serie) {
            $html .= "<li>" . $serie->getName() . "</li>";
        }
        $html .= "</ul>";
        //return new Response($html);

        //return new JsonResponse($seriesList);

        return $this->render('series/index.html.twig', [
            'controller_name' => 'SeriesController',
            'seriesList' => $seriesList,
        ]);

        /*
        return $this->render('series/index.html.twig', [
            'controller_name' => 'SeriesController',
            'seriesList' => $seriesList,
            'successMessage' => $successMessage,
        ]);
        */
    }

    #[Route('/series/create', name: 'app_series_form', methods: ['GET'])]
    public function addSeriesForm(): Response
    {
        /*
        $seriesForm = $this->createFormBuilder(new Series())
            ->add('name',TextType::class, ['label' => 'Nome da Série'])
            ->add('save', SubmitType::class, ['label' => 'Adicionar'])
            ->getForm();
            */
            $seriesForm = $this->createForm(SeriesType::class, new SeriesCreateFormInput());
        return $this->renderForm('series/form.html.twig', array_Merge(compact('seriesForm'),['titleFrom' => 'Nova Série']));
        //return $this->render('series/form.html.twig', []);
    }

    #[Route('/series/create', name: 'app_add_series' , methods: ['POST'])]
    public function addSeries(Request $request): Response
    {
        /*
        $seriesName = $request->request->get('name');
        $series = new Series($seriesName);

        $this->seriesRepository->save($series, true);
        //$session = $request->getSession();
        //$session->set("success","Série \"{$seriesName}\" adicionada com sucesso!");

        $this->addFlash('success', "Série \"{$seriesName}\" adicionada com sucesso!");

        return new RedirectResponse('/series');
        */
        $seriesInput = new SeriesCreateFormInput();
        $seriesForm = $this->createForm(SeriesType::class, $seriesInput)
            ->handleRequest($request);

        if(!$seriesForm->isValid()){
            return $this->renderForm('series/form.html.twig', array_Merge(compact('seriesForm'),['titleFrom' => 'Nova Série']));
        }

        $series = new Series($seriesInput->seriesName);
        for ($seasonCount = 1; $seasonCount <= $seriesInput->seasonsQuantity; $seasonCount++) {
            $season = new Season($seasonCount);
            for ($episodeCount = 1; $episodeCount <= $seriesInput->episodesPerSeason; $episodeCount++) {
                $season->addEpisode(new Episode($episodeCount));
            }
            $series->addSeason($season);
        }

        $this->seriesRepository->save($series, true);

        $this->addFlash('success', "Série \"{$series->getName()}\" adicionada com sucesso!");

        return new RedirectResponse('/series');
    }

    #[Route(
        '/series/delete/{id}',
        name: 'app_delete_series' ,
        methods: ['DELETE'],
        requirements: ['id' => '[0-9]+']
    )]
    public function deleteSeries(int $id, Request $request): Response
    {
        //$id = $resquest->get('id');
        //$id = $resquest->attributes->get('id');
        $this->seriesRepository->removeById($id);
        //$session = $request->getSession();
        //$session->set("success","Série $id removida com sucesso!");

        $this->addFlash('danger', "Série $id removida com sucesso!");
        return new RedirectResponse('/series');
    }

    #[Route(
        '/series/edit/{series}',
        name: 'app_edit_series',
        methods: ['GET']
    )]
    public function editSeriesForm(Series $series): Response
    {
        $seriesForm = $this->createForm(SeriesType::class, $series, ['is_edit'=>true]);
        return $this->renderForm('series/form.html.twig', array_Merge(compact('seriesForm'),['titleFrom' => 'Editar Série']));
        /*
        $seriesForm = $this->createFormBuilder($series)
            ->add('name',TextType::class, ['label' => 'Nome da Série'])
            ->add('save', SubmitType::class, ['label' => 'Editar'])
            ->getForm();

        return $this->renderForm('series/form.html.twig', compact('seriesForm'));
        */

        //return $this->render('series/form.html.twig', compact('series') );
    }

    #[Route(
        '/series/edit/{series}',
        name: 'app_edit_save_series',
        methods: ['PUT','PATCH']
    )]
    public function storeSeriesChanges(Series $series, Request $request): Response
    {
        /*
        $seriesName = $request->request->get('name');
        $series->setName($seriesName);
        $this->entityManager->flush();

        //$session = $request->getSession();
        //$session->set("success","Série \"{$seriesName}\" modificada com sucesso!");

        $this->addFlash('success', "Série \"{$seriesName}\" modificada com sucesso!");
        return new RedirectResponse('/series');
        */

        $seriesForm = $this->createForm(SeriesType::class, $series, ['is_edit'=>true])->handleRequest($request);
        $seriesName = $series->getName();

        if(!$seriesForm->isValid()){
            return $this->renderForm('series/form.html.twig', array_Merge(compact('seriesForm'),['titleFrom' => 'Editar Série']));
        }
        $this->entityManager->flush();

        $this->addFlash('success', "Série \"{$seriesName}\" modificada com sucesso!");
        return new RedirectResponse('/series');
    }
}
