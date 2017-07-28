<?php
namespace App\Http\Controllers;

use Illuminate\Routing\Controller;

use Illuminate\Support\Facades\Response as Response;

use Illuminate\Http\Response as IlluminateResponse;
use Illuminate\Pagination\LengthAwarePaginator;
use Tymon\JWTAuth\Facades\JWTAuth;

class ApiController extends Controller {


    protected $statusCode = 200;


    public function getStatusCode()
    {

        return $this->statusCode;

    }


    public function setStatusCode($statusCode)
    {
        $this->statusCode = $statusCode;

        return $this;
    }


    public function respond($data, $headers = [ ])
    {
        return Response::json($data, $this->getStatusCode(), $headers);
    }

    /**
     * @param LengthAwarePaginator $paginator
     * @param                      $data
     *
     * @return mixed
     */
	protected function respondWithPagination(LengthAwarePaginator $paginator, $data)
	{
        $a = $paginator->toArray();

        unset($a['data']);
		$data = array_merge($data, [
			'paginator' => $a,
		]);

		return $this->respond($data);
	}

    public function respondWithError($message)
    {

        return $this->respond([
            'message'     => $message,
            'status_code' => $this->getStatusCode(),
        ]);

    }


    public function respondNotFound($message = 'Not Found!')
    {
		return $this->setStatusCode(IlluminateResponse::HTTP_NOT_FOUND)->respondWithError($message);
    }


    public function respondWithInternalError($message = 'Internal Error!')
    {

        return $this->setStatusCode(IlluminateResponse::HTTP_INTERNAL_SERVER_ERROR)->respondWithError($message);

    }


    /**
     * @param $message
     *
     * @return mixed
     */
    public function respondFailValidation($message = 'Parameters faild validation')
    {
        return $this->setStatusCode(IlluminateResponse::HTTP_UNPROCESSABLE_ENTITY)->respondWithError($message);
    }


    /**
     * @param $message
     *
     * @return mixed
     */
    protected function respondCreated($message = 'Resource sucessfuly created.')
    {
        return $this->setStatusCode(IlluminateResponse::HTTP_CREATED)->respond([

            'message'     => $message,
            'status_code' => $this->getStatusCode(),

        ]);
    }


    /**
     * @param $message
     *
     * @return mixed
     */
    protected function respondUpdated($message = 'Resource sucessfuly updated.')
    {
        return $this->setStatusCode(IlluminateResponse::HTTP_OK)->respond([

            'message'     => $message,
            'status_code' => $this->getStatusCode(),

        ]);
    }


    /**
     * @param $message
     *
     * @return mixed
     */
    protected function respondDeleted($message = 'Resource sucessfuly deleted.')
    {
        return $this->setStatusCode(IlluminateResponse::HTTP_GONE)->respond([

            'message'     => $message,
            'status_code' => $this->getStatusCode(),

        ]);
    }


    /**
     * @return mixed
     */
    public function loggedUser()
    {
        return JWTAuth::toUser(JWTAuth::getToken());
    }

}
