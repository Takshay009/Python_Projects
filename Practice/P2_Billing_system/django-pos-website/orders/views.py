from rest_framework import viewsets, status
from rest_framework.decorators import action
from rest_framework.response import Response
from .models import Order, OrderItem
from .serializers import OrderSerializer
from products.models import Product

class OrderViewSet(viewsets.ModelViewSet):
    queryset = Order.objects.all()
    serializer_class = OrderSerializer
    
    def perform_create(self, serializer):
        serializer.save(user=self.request.user)
    
    @action(detail=False, methods=['post'])
    def create_order(self, request):
        try:
            data = request.data
            
            order = Order.objects.create(
                user=request.user,
                customer_name=data.get('customer_name'),
                customer_phone=data.get('customer_phone'),
                subtotal=data.get('subtotal'),
                discount=data.get('discount', 0),
                tax=data.get('tax'),
                total=data.get('total'),
                payment_method=data.get('payment_method'),
                status='completed'
            )
            
            for item in data.get('items', []):
                OrderItem.objects.create(
                    order=order,
                    product_id=item['product_id'],
                    quantity=item['quantity'],
                    price=item['price']
                )
            
            return Response(OrderSerializer(order).data, status=status.HTTP_201_CREATED)
        except Exception as e:
            return Response({'error': str(e)}, status=status.HTTP_400_BAD_REQUEST)
    
    @action(detail=False, methods=['get'])
    def dashboard(self, request):
        orders = self.queryset
        return Response({
            'total_sales': sum(o.total for o in orders),
            'total_orders': orders.count(),
        })