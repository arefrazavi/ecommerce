<?php
/**
 * Created by PhpStorm.
 * User: arefr
 * Date: 9/2/2018
 * Time: 2:14 PM
 */

namespace App\Repository\SearchRepository;


use App\Entity\Product;
use App\Model\ProductSearch;
use Elastica\Aggregation\Filter;
use Elastica\Index;
use Elastica\Query;
use Elastica\Query\BoolQuery;
use Elastica\Query\Match;
use Elastica\Query\MatchAll;
use Elastica\Query\Nested;
use Elastica\Query\Range;
use Elastica\Query\Terms;
use FOS\ElasticaBundle\Finder\PaginatedFinderInterface;
use FOS\ElasticaBundle\Repository;
use Pagerfanta\Adapter\ElasticaAdapter;

class ProductSearchRepository extends Repository
{

    public function __construct(PaginatedFinderInterface $finder)
    {
        parent::__construct($finder);
    }

    /**
     * build the elasticsearch query to get a paginated list of products that match criteria
     * @param ProductSearch $productSearch
     * @return \Pagerfanta\Pagerfanta
     */
    public function advancedSearch(ProductSearch $productSearch)
    {

        $title = $productSearch->getTitle();
        $description = $productSearch->getDescription();
        $color = $productSearch->getColor();
        $minPrice = $productSearch->getMinPrice();
        $maxPrice = $productSearch->getMaxPrice();


        $boolQuery = new BoolQuery();

        //Create Query
        if ($title || $description) {
            if ($title) {
                $fieldQuery = new Match();
                $fieldQuery->setFieldQuery('title', $title);
                //$fieldQuery->setFieldParam('title', 'analyzer', 'text_analyzer');
                $fieldQuery->setFieldFuzziness('title', 2);
                $fieldQuery->setFieldBoost('title', 2);
                $fieldQuery->setFieldMinimumShouldMatch('title', '75%');

                $boolQuery->addMust($fieldQuery);
            }

            if ($description) {
                $fieldQuery = new Match();
                $fieldQuery->setFieldQuery('description', $description);
                $fieldQuery->setFieldParam('description', 'analyzer', 'text_analyzer');
                $boolQuery->addShould($fieldQuery);
            }

            if ($color) {
                $fieldQuery = new Match();
                $fieldQuery->setFieldQuery('variants.color', $color);
                $fieldQuery->setFieldParam('variants.color', 'analyzer', 'text_analyzer');
                $boolQuery->addMust($fieldQuery);
            }
        } else {
            $fieldQuery = new MatchAll();
            $boolQuery->addMust($fieldQuery);
        }

        if ($minPrice || $maxPrice) {
            //$nestedQuery = new Nested();
            //$nestedQuery->setPath('variants');
            $rangeQuery = new Range();
            $rangeQuery->addField('variants.price', ['gte' => $minPrice, 'lte' => $maxPrice]);
            //$nestedQuery->setQuery($rangeQuery);
            $boolQuery->addFilter($rangeQuery);
        }

        $query = Query::create($boolQuery);

        //$queryString = json_encode($query->getQuery()->toArray(), JSON_PRETTY_PRINT);
        //die($queryString);


        $pager = $this->findPaginated($query);

        return $pager;
    }

}