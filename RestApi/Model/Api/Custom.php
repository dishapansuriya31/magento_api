<?php 
namespace Kitchen\RestApi\Model\Api;

use Kitchen\RestApi\Api\CustomInterface;
use Kitchen\Review\Model\ReviewsFactory;
use Psr\Log\LoggerInterface;

class Custom implements CustomInterface
{
    private $reviewsfactory;
    protected $response = ['success' => false];
    private $logger;


    public function __construct(
		reviewsfactory $reviewsfactory,
        LoggerInterface $logger

		)
    {
        $this->reviewsfactory = $reviewsfactory;
        $this->logger = $logger;
    }

    /** * POST for Post api * @param array $data * @return string */
    public function saveData($data)
    {
        $insertData = $this->reviewsfactory->create();
        try {
            $insertData->setName($data['name']);
            $insertData->setAdminId($data['id'])
			
			->save();
            $response = ['success' => true, 'message' => $data];
        } catch (\Exception $e) {
            $response = ['success' => false, 'message' => $e->getMessage()];
        }
        return $response;
    }

    /** * @return string */
    public function getUserData()
    {
        try {
            $data = $this->reviewsfactory->create()->getCollection()->getData();
             return $data;
			return ['success' => true, 'data' => $data];
        } catch (\Exception $e) {
            return ['success' => false, 'message' => $e->getMessage()];
        }
    }

    /** * @param int $k_id * @return bool true on success */
    public function getDelete($k_id)
    {
        try {
            if ($k_id) {
                $data = $this->reviewsfactory->create()->load($k_id);
                $data->delete();
                return "success";
            }
        } catch (\Exception $e) {
            $response = ['success' => false, 'message' => $e->getMessage()];
        }
        return "false";
    }
    public function updatedata($id,$name,$description,$rating,$aid,$isactive)
    {
        if ($id) {
            try {
                $model = $this->reviewsfactory->create()->load($id);
                 $model->setName($name);
                 $model->setDescription($description);
                 $model->setRating($rating);
                 $model->setAdminId($aid);
                 $model->setIsActive($isactive);
  
                 $model->save();
                 
                $response = ['status' => true, 'message' => 'updated successfully.'];
                return $response;
            } catch (\Exception $e) {
                $this->logger->error('Error in updateTaxRate: ' . $e->getMessage());
                return ['status' => false, 'message' => $e->getMessage()];
            }
        } 
    }
}