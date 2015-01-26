<?php

class ApiController extends BaseController {

    public function __construct() {}

    /*
     * 0100_Main
     * @params $catId
     *
     * return json
     * */
    public function loadListSubCategory_0100($catId) {
        $params = $this->getApiInput(
            array('INT' => array('catId' => $catId))
        );

        $result     = array();
        $resultCode = self::BAD_REQUEST;
        if($params['isParam']) {
            if ($catId) {
                $subCategory = Category::select('id', 'name')
                    ->where('parent_id', $catId)->get();

                if ($subCategory) {
                    $result = $subCategory->toArray();
                }
            }
            $resultCode = 0;
        }

        return $this->jsonResponse($result, $resultCode);
    }

    /*
     * 0100_Main
     * @params $catId
     * @params $page
     *
     * return json
     * */
    public function loadListShopImage_0100($catId, $page) {
        $params = $this->getApiInput(
            array('INT' => array('catId' => $catId, 'page' => $page))
        );

        $result     = array();
        $resultCode = self::BAD_REQUEST;
        if($params['isParam']) {
            $limit  = Config::get('constants.LIMIT');
            $result = array('totalPage' => 0, 'totalItems' => 0, 'data' => array(), 'limit' => $limit);
            if ($catId) {
                $subCategory = $query = Detail::select('detail.id', 'detail.title', 'shop_category.category_id', 'detail.thump_image AS url_image')
                    ->leftjoin('shop_category', 'shop_category.detail_id', '=', 'detail.id')
                    ->where('shop_category.category_id', $catId)
                    ->orderBy('detail.id', 'DESC')
                    ->groupBy('detail.id')
                    ->getPager($page, $limit);

                if ($subCategory['data']) {
                    $data = $subCategory['data']->toArray();
                    foreach($data as $key => $item) {
                        if ($item['url_image']) {
                            $data[$key]['url_image'] = asset('')
                                . DetailImage::createPathNormalDetailImage($item['url_image']);
                        }
                    }
                    $result['data']       = $data;
                    $result['totalPage']  = $subCategory['totalPage'];
                    $result['totalItems'] = $subCategory['totalItems'];
                }
            }
            $resultCode = 0;
        }

        return $this->pagerJsonResponse($result, $resultCode);
    }

    /*
    * 0301_RM_Favorites
    * @params $id
    * */
    public function loadListFavoriteShop_0301($imei, $rootCatId)
    {
        $category = Category::where('id', $rootCatId);

        if($category->first()) {
            $favoriteShop = FavoriteShop::where('imei', $imei)
                ->where('favorite_shop.root_category_id', $rootCatId)
                ->join('detail', 'detail.id', '=', 'favorite_shop.shop_id')
                ->groupBy('detail.id')
                ->get(array('detail.id', 'detail.title', 'detail.address', 'detail.content', 'detail.thump_image AS url_image'));
            $result = array();
            if($favoriteShop->first()) {
                $result = $favoriteShop->toArray();

                foreach($result as $key => $item) {
                    if ($item['url_image']) {
                        $result[$key]['url_image'] = asset('')
                            . DetailImage::createPathThumpsDetailImage($item['url_image']);
                    }
                }
            }

            return $this->jsonResponse($result);
        }

        return $this->jsonResponse(array(), BaseController::FORBIDDEN);
    }

    /*
    * 0302_RM_MessageBox
    * */
    public function loadListMessage_0302() {
        $result  = array();
        $message = Message::select('id', 'title', 'content', 'created_date')->get();

        if ($message) {
            $result = $message->toArray();
        }

        return $this->jsonResponse($result);
    }

    /*
    * 0302_RM_MessageBox
    * @params $messId
    * */
    public function loadMessageById_0302($messId) {
        $result  = array();
        if ($messId) {
            $message = Message::select('id', 'title', 'content', 'created_date')
                ->where('id', $messId)->first();

            if ($message) {
                $result = $message->toArray();
            }
        }

        return $this->jsonResponse($result);
    }

    /*
    * 0400_Search
    * @params $imei
    * @params $rootCatId
    * */
    public function loadListFavoriteRoad_0400($imei, $rootCatId) {
        $category = Category::where('id',$rootCatId);

        if($category->first()) {
            $favoriteRoad = FavoriteRoad::where('imei', $imei)
                ->where('favorite_road.root_category_id', $rootCatId)
                ->join('road', 'road.id', '=', 'favorite_road.road_id')
                ->get(array('road.id', 'road.name'));
            $result = array();
            if($favoriteRoad->first()) {
                $result = $favoriteRoad->toArray();
            }

            return $this->jsonResponse($result);
        }

        return $this->jsonResponse(array(), BaseController::FORBIDDEN);
    }

    /*
    * 0401_SearchDetail
    * @params $id
    * */
    public function loadListRoad_0401()
    {
        $dataChild = array();
        $result    = array();

        $roadRoot = Road::select('id', 'name', 'parent_id')
            ->whereNull('parent_id')->get();
        $road     = Road::select('id', 'name', 'parent_id')
            ->whereNotNull('parent_id')->get();
        if ($road) {
            $dataChild = $road->toArray();
        }

        if ($roadRoot) {
            $dataRoot = $roadRoot->toArray();
            if ($dataChild) {
                foreach ($dataRoot as $key => $rootItem) {
                    $result[$key] = $rootItem;
                    foreach ($dataChild as $childItem) {
                        if ($rootItem['id'] == $childItem['parent_id']) {
                            $result[$key]['child'][] = $childItem;
                        }
                    }
                }
            } else {
                $result = $dataRoot;
            }
        }

        return $this->jsonResponse($result);
    }

    /*
    * 0402_SearchResult
    * @params $catId
    * @params $roadId
    * */
    public function loadListShopImage_0402($imei, $rootCatId, $roadId, $page) {
        $limit  = Config::get('constants.LIMIT');
        $result = array('totalPage' => 0, 'totalItems' => 0, 'data' => array(), 'limit' => $limit);

        $subCategory = $query = Detail::select('detail.id', 'shop_category.root_category_id', 'detail.thump_image AS url_image')
            ->leftjoin('shop_category', 'shop_category.detail_id', '=', 'detail.id')
            ->leftjoin('shop_road', 'shop_road.detail_id', '=', 'detail.id')
            ->where('shop_category.root_category_id', $rootCatId)
            ->where('shop_road.road_id', $roadId)
            ->orderBy('detail.id', 'DESC')
            ->groupBy('detail.id')
            ->getPager($page, $limit);

        if ($subCategory['data']) {
            $data = $subCategory['data']->toArray();

            foreach($data as $key => $item) {
                if ($item['url_image']) {
                    $data[$key]['url_image'] = asset('')
                        . DetailImage::createPathNormalDetailImage($item['url_image']);
                }
            }
            $result['data']       = $data;
            $result['totalPage']  = $subCategory['totalPage'];
            $result['totalItems'] = $subCategory['totalItems'];
        }

        $favoriteRoad = FavoriteRoad::where('imei', $imei)
            ->where('root_category_id', $rootCatId)
            ->where('road_id', $roadId)->first();

        $result['isFavorite'] = false;
        if ($favoriteRoad) {
            $result['isFavorite'] = true;
        }

        return $this->pagerJsonResponse($result);
    }

    public function addFavoriteRoad_0403($imei, $rootCatId, $roadId) {
        $category = Category::find($rootCatId);
        $road     = Road::find($roadId);
        $favoriteRoad = FavoriteRoad::where('imei', $imei)
            ->where('root_category_id', $rootCatId)
            ->where('road_id', $roadId)->get();

        if($favoriteRoad) {
            $favoriteRoad = $favoriteRoad->toArray();
        }

        $arrData = array('imei' => $imei, 'root_category_id' => $rootCatId, 'road_id' => $roadId);

        if(!$favoriteRoad && $category && $road) {
            $arrData['id'] = FavoriteRoad::insertGetId($arrData);
        }
        $isError = 0;
        if(empty($arrData['id'])) {
            $isError = BaseController::CONFLICT;
        }

        return $this->jsonResponse($arrData, $isError);
    }

    public function deleteFavoriteRoad_0403($imei, $rootCatId, $roadId) {
        $favoriteRoad = FavoriteRoad::where('imei', $imei)
            ->where('root_category_id', $rootCatId)
            ->where('road_id', $roadId);
        if($favoriteRoad->first()) {
            $id = $favoriteRoad->first()['id'];
            $favoriteRoad->delete();

            return $this->jsonResponse(array('id' => $id));
        }

        return $this->jsonResponse(array(), BaseController::FORBIDDEN);
    }

    /*
    * 0500_Detail
    * @params $shopId
    * */
    public function loadShop_0500($imei, $rootCatId, $shopId) {
        $result = array();
        $query  = Detail::with('detailImages')
            ->select('detail.id', 'shop_category.category_id', 'detail.title', 'detail.content', 'detail.phone','detail.address')
            ->leftjoin('shop_category', 'shop_category.detail_id', '=', 'detail.id')
            ->where('detail.id', $shopId);
        $detail = $query->first();
        if ($detail) {
            $details = $result = $detail->toArray();
            $result['detail_images'] = array();

            if (isset($details['detail_images']) && ($detailImages = $details['detail_images'])) {
                foreach($detailImages as $key => $item) {
                    $result['detail_images'][$key]['url_image'] = asset('')
                        . DetailImage::createPathLargeDetailImage($item['name']);
                }
            }

            $favoriteShop = FavoriteShop::where('imei', $imei)
                ->where('root_category_id', $rootCatId)
                ->where('shop_id', $shopId)->first();

            $result['isFavorite'] = false;
            if ($favoriteShop) {
                $result['isFavorite'] = true;
            }
        }

        return $this->jsonResponse($result);
    }

    public function addFavoriteShop_0500($imei, $rootCatId, $shopId) {
        $category = Category::find($rootCatId);
        $shop     = Detail::find($shopId);
        $favoriteShop = FavoriteShop::where('imei', $imei)
            ->where('root_category_id', $rootCatId)
            ->where('shop_id', $shopId)->get();

        if($favoriteShop) {
            $favoriteShop = $favoriteShop->toArray();
        }

        $arrData = array('imei' => $imei, 'root_category_id' => $rootCatId, 'shop_id' => $shopId);

        if(!$favoriteShop && $category && $shop) {
            $arrData['id'] = FavoriteShop::insertGetId($arrData);
        }
        $isError = 0;
        if(empty($arrData['id'])) {
            $isError = BaseController::CONFLICT;
        }

        return $this->jsonResponse($arrData, $isError);
    }

    public function deleteFavoriteShop_0500($imei, $rootCatId, $shopId) {
        $favoriteShop = FavoriteShop::where('imei', $imei)
            ->where('root_category_id', $rootCatId)
            ->where('shop_id', $shopId);
        if($favoriteShop->first()) {
            $id = $favoriteShop->first()['id'];
            $favoriteShop->delete();

            return $this->jsonResponse(array('id' => $id));
        }

        return $this->jsonResponse(array(), BaseController::FORBIDDEN);
    }
}
