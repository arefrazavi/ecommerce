<?php

namespace App\Controller;

use App\Entity\Product;
use App\Form\ProductSearchType;
use App\Model\ProductSearch;
use Pagerfanta\Adapter\ArrayAdapter;
use Pagerfanta\Adapter\DoctrineORMAdapter;
use Pagerfanta\Pagerfanta;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\Routing\Annotation\Route;

class ProductController extends Controller
{

    /**
     * @Route("/products/{page<\d+>?1}", name="product_list")
     */
    public function index(Request $request)
    {

        $productSearch = new ProductSearch();

        $productSearchForm = $this->createForm(ProductSearchType::class, $productSearch);
        $productSearchForm->handleRequest($request);

        $productSearchData = $productSearchForm->getData();
        $elasticaManager = $this->container->get('fos_elastica.manager');
        $repository = $elasticaManager->getRepository(Product::class);
        $pager = $repository->advancedSearch($productSearchData);
        $pager->setMaxPerPage($productSearch->getMaxPerPage());
        $pager->setCurrentPage($request->get("page"));

        $searchForm = $productSearchForm->createView();


        return $this->render('product/index.html.twig', array(
            'pager' => $pager,
            'SearchForm' => $searchForm,
        ));
    }
}
